<?php
namespace Auth0\Tests;

use Auth0\SDK\Auth0;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\Exception\CoreException;

use Auth0\Tests\Traits\ErrorHelpers;

use Firebase\JWT\JWT;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Class Auth0Test
 *
 * @package Auth0\Tests
 */
class Auth0Test extends \PHPUnit_Framework_TestCase
{

    use ErrorHelpers;

    /**
     * Basic Auth0 class config options.
     *
     * @var array
     */
    public static $baseConfig = [
        'domain'        => '__test_domain__',
        'client_id'     => '__test_client_id__',
        'client_secret' => '__test_client_secret__',
        'redirect_uri'  => '__test_redirect_uri__',
        'store' => false,
        'state_handler' => false,
        'scope' => 'openid offline_access',
    ];

    /**
     * Default request headers.
     *
     * @var array
     */
    protected static $headers = [ 'content-type' => 'json' ];

    /**
     * Runs after each test completes.
     */
    public function tearDown()
    {
        parent::tearDown();
        $_GET = [];
    }

    /**
     * Test that the exchange call returns false before making any HTTP calls if no code is present.
     *
     * @throws ApiException
     * @throws CoreException
     */
    public function testThatExchangeReturnsFalseIfNoCodePresent()
    {
        $auth0 = new Auth0( self::$baseConfig );
        $this->assertFalse( $auth0->exchange() );
    }

    /**
     * Test that the exchanges succeeds when there is both and access token and an ID token present.
     *
     * @throws ApiException
     * @throws CoreException
     */
    public function testThatExchangeSucceedsWithIdToken()
    {
        $id_token_payload = ['sub' => '123'];
        $id_token         = JWT::encode( $id_token_payload, '__test_client_secret__' );
        $response_body    = '{"access_token":"1.2.3","id_token":"'.$id_token.'","refresh_token":"4.5.6"}';

        $mock = new MockHandler( [
            // Code exchange response.
            new Response( 200, self::$headers, $response_body ),
            // Userinfo response.
            new Response( 200, self::$headers, json_encode( $id_token_payload ) ),
        ] );

        $add_config   = ['guzzle_options' => ['handler' => HandlerStack::create($mock)]];
        $auth0        = new Auth0( self::$baseConfig + $add_config );
        $_GET['code'] = uniqid();

        $this->assertTrue( $auth0->exchange() );
        $this->assertEquals( $id_token_payload, $auth0->getUser() );
        $this->assertEquals( $id_token, $auth0->getIdToken() );
        $this->assertEquals( '1.2.3', $auth0->getAccessToken() );
        $this->assertEquals( '4.5.6', $auth0->getRefreshToken() );
    }

    /**
     * Test that the exchanges succeeds when there is only an access token.
     *
     * @throws ApiException
     * @throws CoreException
     */
    public function testThatExchangeSucceedsWithNoIdToken()
    {
        $mock = new MockHandler( [
            // Code exchange response.
            // Respond with no ID token, access token with correct number of segments.
            new Response( 200, self::$headers, '{"access_token":"1.2.3","refresh_token":"4.5.6"}' ),
            // Userinfo response.
            new Response( 200, self::$headers, '{"sub":"123"}' ),
        ] );

        $add_config   = [
            'scope' => 'offline_access read:messages',
            'audience' => 'https://api.identifier',
            'guzzle_options' => [ 'handler' => HandlerStack::create($mock) ]
        ];
        $auth0        = new Auth0( self::$baseConfig + $add_config );
        $_GET['code'] = uniqid();

        $this->assertTrue( $auth0->exchange() );
        $this->assertEquals( ['sub' => '123'], $auth0->getUser() );
        $this->assertEquals( '1.2.3', $auth0->getAccessToken() );
        $this->assertEquals( '4.5.6', $auth0->getRefreshToken() );
    }

    /**
     * Test that the skip_userinfo config option uses the ID token instead of calling /userinfo.
     *
     * @throws ApiException
     * @throws CoreException
     */
    public function testThatExchangeSkipsUserinfo()
    {
        $id_token_payload = ['sub' => 'correct_sub'];
        $id_token         = JWT::encode( $id_token_payload, '__test_client_secret__' );

        $mock = new MockHandler( [
            // Code exchange response.
            new Response( 200, self::$headers, '{"access_token":"1.2.3","id_token":"'.$id_token.'"}' ),
        ] );

        $add_config   = [
            'scope' => 'openid',
            'skip_userinfo' => true,
            'guzzle_options' => [ 'handler' => HandlerStack::create($mock) ]
        ];
        $auth0        = new Auth0( self::$baseConfig + $add_config );
        $_GET['code'] = uniqid();

        $this->assertTrue( $auth0->exchange() );
        $this->assertEquals( ['sub' => 'correct_sub'], $auth0->getUser() );
        $this->assertEquals( $id_token, $auth0->getIdToken() );
        $this->assertEquals( '1.2.3', $auth0->getAccessToken() );
    }

    /**
     * Test that renewTokens fails if there is no access_token stored.
     *
     * @throws ApiException Should not be thrown in this test.
     */
    public function testThatRenewTokensFailsIfThereIsNoAccessToken()
    {
        $auth0 = new Auth0( self::$baseConfig );

        try {
            $caught_exception = false;
            $auth0->renewTokens();
        } catch (CoreException $e) {
            $caught_exception = $this->errorHasString( $e, "Can't renew the access token if there isn't one valid" );
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test that renewTokens fails if there is no refresh_token stored.
     *
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatRenewTokensFailsIfThereIsNoRefreshToken()
    {
        $mock = new MockHandler( [
            // Code exchange response.
            new Response( 200, self::$headers, '{"access_token":"1.2.3"}' ),
        ] );

        $add_config = [
            'skip_userinfo' => true,
            'persist_access_token' => true,
            'guzzle_options' => [ 'handler' => HandlerStack::create($mock) ]
        ];
        $auth0      = new Auth0( self::$baseConfig + $add_config );

        $_GET['code'] = uniqid();
        $this->assertTrue( $auth0->exchange() );

        try {
            $caught_exception = false;
            $auth0->renewTokens();
        } catch (CoreException $e) {
            $caught_exception = $this->errorHasString(
                $e,
                "Can't renew the access token if there isn't a refresh token available" );
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test that renewTokens fails if the API response is invalid.
     *
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatRenewTokensFailsIfNoAccessOrIdTokenReturned()
    {
        $mock = new MockHandler( [
            // Code exchange response.
            new Response( 200, self::$headers, '{"access_token":"1.2.3","refresh_token":"2.3.4"}' ),
            // Refresh token response without ID token.
            new Response( 200, self::$headers, '{"access_token":"1.2.3"}' ),
            // Refresh token response without access token.
            new Response( 200, self::$headers, '{"id_token":"1.2.3"}' ),
        ] );

        $add_config = [
            'skip_userinfo' => true,
            'persist_access_token' => true,
            'guzzle_options' => [ 'handler' => HandlerStack::create($mock) ]
        ];
        $auth0      = new Auth0( self::$baseConfig + $add_config );

        $_GET['code'] = uniqid();
        $this->assertTrue( $auth0->exchange() );

        try {
            $caught_exception = false;
            $auth0->renewTokens();
        } catch (ApiException $e) {
            $caught_exception = $this->errorHasString(
                $e,
                'Token did not refresh correctly. Access or ID token not provided' );
        }

        $this->assertTrue( $caught_exception );

        // Run the same method again to get next queued response without an access token.
        try {
            $caught_exception = false;
            $auth0->renewTokens();
        } catch (ApiException $e) {
            $caught_exception = $this->errorHasString(
                $e,
                'Token did not refresh correctly. Access or ID token not provided' );
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test that renewTokens succeeds with non-empty access_token and refresh_token stored.
     *
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatRenewTokensSucceeds()
    {
        $id_token = JWT::encode( ['sub' => uniqid()], '__test_client_secret__' );

        $mock = new MockHandler( [
            // Code exchange response.
            new Response( 200, self::$headers, '{"access_token":"1.2.3","refresh_token":"2.3.4"}' ),
            // Refresh token response.
            new Response( 200, self::$headers, '{"access_token":"__test_access_token__","id_token":"'.$id_token.'"}' ),
        ] );

        $add_config = [
            'skip_userinfo' => true,
            'persist_access_token' => true,
            'guzzle_options' => [ 'handler' => HandlerStack::create($mock) ]
        ];
        $auth0      = new Auth0( self::$baseConfig + $add_config );

        $_GET['code'] = uniqid();

        $this->assertTrue( $auth0->exchange() );
        $auth0->renewTokens();

        $this->assertEquals( '__test_access_token__', $auth0->getAccessToken() );
        $this->assertEquals( $id_token, $auth0->getIdToken() );
    }

    public function testThatGetLoginUrlUsesDefaultValues()
    {
        $auth0 = new Auth0( self::$baseConfig );

        $parsed_url = parse_url( $auth0->getLoginUrl() );

        $this->assertEquals( 'https', $parsed_url['scheme'] );
        $this->assertEquals( '__test_domain__', $parsed_url['host'] );
        $this->assertEquals( '/authorize', $parsed_url['path'] );

        $url_query = explode( '&', $parsed_url['query'] );

        $this->assertContains( 'scope=openid%20offline_access', $url_query );
        $this->assertContains( 'response_type=code', $url_query );
        $this->assertContains( 'redirect_uri=__test_redirect_uri__', $url_query );
        $this->assertContains( 'client_id=__test_client_id__', $url_query );
    }

    public function testThatGetLoginUrlAddsValues()
    {
        $auth0 = new Auth0( self::$baseConfig );

        $custom_params = [
            'connection' => '__test_connection__',
            'prompt' => 'none',
            'audience' => '__test_audience__',
            'state' => '__test_state__',
        ];

        $auth_url         = $auth0->getLoginUrl( $custom_params );
        $parsed_url_query = parse_url( $auth_url, PHP_URL_QUERY );
        $url_query        = explode( '&', $parsed_url_query );

        $this->assertContains( 'redirect_uri=__test_redirect_uri__', $url_query );
        $this->assertContains( 'client_id=__test_client_id__', $url_query );
        $this->assertContains( 'connection=__test_connection__', $url_query );
        $this->assertContains( 'prompt=none', $url_query );
        $this->assertContains( 'audience=__test_audience__', $url_query );
        $this->assertContains( 'state=__test_state__', $url_query );
    }

    public function testThatGetLoginUrlOverridesDefaultValues()
    {
        $auth0 = new Auth0( self::$baseConfig );

        $override_params = [
            'scope' => 'openid profile email',
            'response_type' => 'id_token',
            'response_mode' => 'form_post',
        ];

        $auth_url         = $auth0->getLoginUrl( $override_params );
        $parsed_url_query = parse_url( $auth_url, PHP_URL_QUERY );
        $url_query        = explode( '&', $parsed_url_query );

        $this->assertContains( 'scope=openid%20profile%20email', $url_query );
        $this->assertContains( 'response_type=id_token', $url_query );
        $this->assertContains( 'response_mode=form_post', $url_query );
        $this->assertContains( 'redirect_uri=__test_redirect_uri__', $url_query );
        $this->assertContains( 'client_id=__test_client_id__', $url_query );
    }

    public function testThatGetLoginUrlGeneratesState()
    {
        $custom_config = self::$baseConfig;
        unset( $custom_config['state_handler'] );

        $auth0 = new Auth0( $custom_config );

        // Ignore cookie error triggered when session is started.
        // phpcs:ignore
        $auth_url = @$auth0->getLoginUrl();

        $parsed_url_query = parse_url( $auth_url, PHP_URL_QUERY );
        $url_query        = explode( '&', $parsed_url_query );

        $this->assertContains( 'state='.$_SESSION['auth0__webauth_state'], $url_query );
    }
}
