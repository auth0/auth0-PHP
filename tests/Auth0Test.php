<?php
namespace Auth0\Tests;

use Auth0\SDK\Auth0;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Store\SessionStore;
use Auth0\Tests\Traits\ErrorHelpers;
use Firebase\JWT\JWT;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class Auth0Test
 *
 * @package Auth0\Tests
 */
class Auth0Test extends TestCase
{

    use ErrorHelpers;

    /**
     * Basic Auth0 class config options.
     *
     * @var array
     */
    public static $baseConfig;

    /**
     * Default request headers.
     *
     * @var array
     */
    protected static $headers = [ 'content-type' => 'json' ];

    /**
     * Runs after each test completes.
     */
    public function setUp()
    {
        parent::setUp();

        self::$baseConfig = [
            'domain'        => '__test_domain__',
            'client_id'     => '__test_client_id__',
            'client_secret' => '__test_client_secret__',
            'redirect_uri'  => '__test_redirect_uri__',
            'store' => false,
            'auth_store' => new SessionStore(),
            'state_handler' => false,
            'scope' => 'openid offline_access',
        ];

        if (! session_id()) {
            session_start();
        }
    }

    /**
     * Runs after each test completes.
     */
    public function tearDown()
    {
        parent::tearDown();
        $_GET     = [];
        $_SESSION = [];
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
        $id_token      = self::getIdToken();
        $response_body = '{"access_token":"1.2.3","id_token":"'.$id_token.'","refresh_token":"4.5.6"}';

        $mock = new MockHandler( [
            // Code exchange response.
            new Response( 200, self::$headers, $response_body ),
            // Userinfo response.
            new Response( 200, self::$headers, json_encode( ['sub' => '__test_sub__'] ) ),
        ] );

        $add_config               = [
            'skip_userinfo' => false,
            'id_token_alg' => 'HS256',
            'guzzle_options' => [
                'handler' => HandlerStack::create($mock)
            ]
        ];
        $auth0                    = new Auth0( self::$baseConfig + $add_config );
        $_GET['code']             = uniqid();
        $_SESSION['auth0__nonce'] = '__test_nonce__';

        $this->assertTrue( $auth0->exchange() );
        $this->assertEquals( ['sub' => '__test_sub__'], $auth0->getUser() );
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
            'skip_userinfo' => false,
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
        $id_token = self::getIdToken();

        $mock = new MockHandler( [
            // Code exchange response.
            new Response( 200, self::$headers, '{"access_token":"1.2.3","id_token":"'.$id_token.'"}' ),
        ] );

        $add_config               = [
            'scope' => 'openid',
            'skip_userinfo' => true,
            'id_token_alg' => 'HS256',
            'guzzle_options' => [ 'handler' => HandlerStack::create($mock) ]
        ];
        $auth0                    = new Auth0( self::$baseConfig + $add_config );
        $_GET['code']             = uniqid();
        $_SESSION['auth0__nonce'] = '__test_nonce__';

        $this->assertTrue( $auth0->exchange() );

        $this->assertEquals( '__test_sub__', $auth0->getUser()['sub'] );
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
        $id_token = self::getIdToken();

        $mock = new MockHandler( [
            // Code exchange response.
            new Response( 200, self::$headers, '{"access_token":"1.2.3","refresh_token":"2.3.4"}' ),
            // Refresh token response.
            new Response( 200, self::$headers, '{"access_token":"__test_access_token__","id_token":"'.$id_token.'"}' ),
        ] );
        $handler         = HandlerStack::create($mock);
        $handler->push( Middleware::history($request_history) );

        $add_config = [
            'id_token_alg' => 'HS256',
            'skip_userinfo' => true,
            'persist_access_token' => true,
            'guzzle_options' => [ 'handler' => $handler ]
        ];
        $auth0      = new Auth0( self::$baseConfig + $add_config );

        $_GET['code']             = uniqid();
        $_SESSION['auth0__nonce'] = '__test_nonce__';

        $this->assertTrue( $auth0->exchange() );
        $auth0->renewTokens(['scope' => 'openid']);

        $this->assertEquals( '__test_access_token__', $auth0->getAccessToken() );
        $this->assertEquals( $id_token, $auth0->getIdToken() );

        $renew_request = $request_history[1]['request'];
        $renew_body    = json_decode($renew_request->getBody(), true);
        $this->assertEquals( 'openid', $renew_body['scope'] );
        $this->assertEquals( '__test_client_secret__', $renew_body['client_secret'] );
        $this->assertEquals( '__test_client_id__', $renew_body['client_id'] );
        $this->assertEquals( '2.3.4', $renew_body['refresh_token'] );
        $this->assertEquals( 'https://__test_domain__/oauth/token', (string) $renew_request->getUri() );
    }

    public function testThatGetLoginUrlUsesDefaultValues()
    {
        $auth0 = new Auth0( self::$baseConfig );

        $parsed_url = parse_url( $auth0->getLoginUrl() );

        $this->assertEquals( 'https', $parsed_url['scheme'] );
        $this->assertEquals( '__test_domain__', $parsed_url['host'] );
        $this->assertEquals( '/authorize', $parsed_url['path'] );

        $url_query = explode( '&', $parsed_url['query'] );

        $this->assertContains( 'scope=openid%20profile%20email', $url_query );
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

    public function testThatGetLoginUrlGeneratesStateAndNonce()
    {
        $custom_config = self::$baseConfig;
        unset( $custom_config['state_handler'] );

        $auth0 = new Auth0( $custom_config );

        $auth_url = $auth0->getLoginUrl();

        $parsed_url_query = parse_url( $auth_url, PHP_URL_QUERY );
        $url_query        = explode( '&', $parsed_url_query );

        $this->assertArrayHasKey( 'auth0__webauth_state', $_SESSION );
        $this->assertContains( 'state='.$_SESSION['auth0__webauth_state'], $url_query );
        $this->assertArrayHasKey( 'auth0__nonce', $_SESSION );
        $this->assertContains( 'nonce='.$_SESSION['auth0__nonce'], $url_query );
    }

    /**
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatClientSecretIsNotDecodedByDefault()
    {
        $request_history = [];
        $mock            = new MockHandler([
            new Response(200, [ 'Content-Type' => 'json' ], '{"access_token":"1.2.3"}'),
        ]);
        $handler         = HandlerStack::create($mock);
        $handler->push( Middleware::history($request_history) );

        $_GET['code']  = uniqid();
        $custom_config = array_merge(self::$baseConfig, [
            'skip_userinfo' => true,
            'guzzle_options' => [
                'handler' => $handler,
            ]
        ]);

        $auth0 = new Auth0( $custom_config );
        $auth0->exchange();

        $request_body = $request_history[0]['request']->getBody()->getContents();
        $request_body = json_decode($request_body, true);

        $this->assertArrayHasKey( 'client_secret', $request_body );
        $this->assertEquals( '__test_client_secret__', $request_body['client_secret'] );
    }

    /**
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatClientSecretIsDecodedBeforeSending()
    {
        $request_history = [];
        $mock            = new MockHandler([
            new Response(200, [ 'Content-Type' => 'json' ], '{"access_token":"1.2.3"}'),
        ]);
        $handler         = HandlerStack::create($mock);
        $handler->push( Middleware::history($request_history) );

        $_GET['code']  = uniqid();
        $custom_config = array_merge(self::$baseConfig, [
            'client_secret' => JWT::urlsafeB64Encode( '__test_encoded_client_secret__' ),
            'secret_base64_encoded' => true,
            'skip_userinfo' => true,
            'guzzle_options' => [
                'handler' => $handler,
            ]
        ]);

        $auth0 = new Auth0( $custom_config );
        $auth0->exchange();

        $request_body = $request_history[0]['request']->getBody()->getContents();
        $request_body = json_decode($request_body, true);

        $this->assertArrayHasKey( 'client_secret', $request_body );
        $this->assertEquals( '__test_encoded_client_secret__', $request_body['client_secret'] );
    }

    public function testThatMaxAgeIsSetInLoginUrlFromInitialConfig()
    {
        $custom_config            = self::$baseConfig;
        $custom_config['max_age'] = 1000;
        $auth0                    = new Auth0( $custom_config );

        $auth_url = $auth0->getLoginUrl();

        $parsed_url_query = parse_url( $auth_url, PHP_URL_QUERY );
        $url_query        = explode( '&', $parsed_url_query );

        $this->assertContains( 'max_age=1000', $url_query );
        $this->assertArrayHasKey( 'auth0__max_age', $_SESSION );
        $this->assertEquals( 1000, $_SESSION['auth0__max_age'] );
    }

    public function testThatMaxAgeIsOverriddenInLoginUrl()
    {
        $custom_config            = self::$baseConfig;
        $custom_config['max_age'] = 1000;
        $auth0                    = new Auth0( $custom_config );

        $auth_url = $auth0->getLoginUrl(['max_age' => 1001]);

        $parsed_url_query = parse_url( $auth_url, PHP_URL_QUERY );
        $url_query        = explode( '&', $parsed_url_query );

        $this->assertContains( 'max_age=1001', $url_query );
        $this->assertArrayHasKey( 'auth0__max_age', $_SESSION );
        $this->assertEquals( 1001, $_SESSION['auth0__max_age'] );
    }

    /**
     * @throws ApiException
     * @throws CoreException
     * @throws InvalidTokenException
     */
    public function testThatIdTokenIsPersistedWhenSet()
    {
        $custom_config = array_merge( self::$baseConfig, [
            'id_token_alg' => 'HS256',
            'persist_id_token' => true,
            'store' => new SessionStore(),
        ]);

        $auth0    = new Auth0( $custom_config );
        $id_token = self::getIdToken();

        $_SESSION['auth0__nonce']   = '__test_nonce__';
        $_SESSION['auth0__max_age'] = 1000;
        $auth0->setIdToken( $id_token );

        $this->assertEquals($id_token, $auth0->getIdToken());
        $this->assertEquals($id_token, $_SESSION['auth0__id_token']);
    }

    /**
     * @throws CoreException
     */
    public function testThatEmptyApplicationNonceFailsIdTokenValidation()
    {
        $custom_config = self::$baseConfig + ['id_token_alg' => 'HS256'];
        $auth0         = new Auth0( $custom_config );
        $id_token      = self::getIdToken();

        $this->assertArrayNotHasKey('auth0__nonce', $_SESSION);

        $e_message = 'No exception caught';
        try {
            $auth0->setIdToken( $id_token );
        } catch (InvalidTokenException $e) {
            $e_message = $e->getMessage();
        }

        $this->assertStringStartsWith('Nonce value not found in application store', $e_message);
    }

    /**
     * @throws CoreException
     */
    public function testThatIdTokenNonceIsCheckedWhenSet()
    {
        $custom_config = self::$baseConfig + ['id_token_alg' => 'HS256'];
        $auth0         = new Auth0( $custom_config );
        $id_token      = self::getIdToken();

        $_SESSION['auth0__nonce'] = '__invalid_nonce__';
        $e_message                = 'No exception caught';
        try {
            $auth0->setIdToken( $id_token );
        } catch (InvalidTokenException $e) {
            $e_message = $e->getMessage();
        }

        $this->assertStringStartsWith('Nonce (nonce) claim mismatch in the ID token', $e_message);
    }

    /**
     * @throws CoreException
     */
    public function testThatIdTokenAuthTimeIsCheckedWhenSet()
    {
        $custom_config = self::$baseConfig + ['id_token_alg' => 'HS256', 'max_age' => 10 ];
        $auth0         = new Auth0( $custom_config );
        $id_token      = self::getIdToken();

        $_SESSION['auth0__nonce'] = '__test_nonce__';
        $e_message                = 'No exception caught';
        try {
            $auth0->setIdToken( $id_token );
        } catch (InvalidTokenException $e) {
            $e_message = $e->getMessage();
        }

        $this->assertStringStartsWith(
            'Authentication Time (auth_time) claim in the ID token indicates that too much time has passed',
            $e_message
        );
    }

    /**
     * @throws ApiException
     * @throws CoreException
     * @throws InvalidTokenException
     */
    public function testThatIdTokenLeewayFromConstructorIsUsed()
    {
        $custom_config = self::$baseConfig + ['id_token_leeway' => 120, 'id_token_alg' => 'HS256'];
        $auth0         = new Auth0( $custom_config );

        // Set the token expiration time past the default leeway of 60 seconds.
        $id_token = self::getIdToken(['exp' => time() - 100]);

        $_SESSION['auth0__nonce'] = '__test_nonce__';

        $auth0->setIdToken( $id_token );
        $this->assertEquals( $id_token, $auth0->getIdToken() );
    }

    /*
     * Test helper methods.
     */

    public static function getIdToken(array $overrides = [])
    {
        $id_token_payload = [
            'sub' => '__test_sub__',
            'iss' => 'https://__test_domain__/',
            'aud' => '__test_client_id__',
            'nonce' => '__test_nonce__',
            'auth_time' => time() - 100,
            'exp' => time() + 1000,
            'iat' => time() - 1000,
        ];
        return JWT::encode( array_merge($id_token_payload, $overrides), '__test_client_secret__' );
    }
}
