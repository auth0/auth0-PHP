<?php
namespace Auth0\Tests;

use Auth0\SDK\Auth0;
use Firebase\JWT\JWT;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * Class Auth0Test
 *
 * @package Auth0\Tests
 */
class Auth0Test extends \PHPUnit_Framework_TestCase
{

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
    public function tearDown() {
        parent::tearDown();
        $_GET = [];
    }

    /**
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function testThatExchangeReturnsFalseIfNoCodePresent() {
        $auth0 = new Auth0( self::$baseConfig );
        $this->assertFalse( $auth0->exchange() );
    }

    /**
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function testThatExchangeSucceedsWithIdToken() {

        $id_token_payload = ['sub' => '123'];
        $id_token = JWT::encode( $id_token_payload, '__test_client_secret__' );

        $mock = new MockHandler( [
            // Code exchange response.
            new Response( 200, self::$headers, '{"access_token":"1.2.3","id_token":"' . $id_token . '"}' ),
            // Userinfo response.
            new Response( 200, self::$headers, json_encode( $id_token_payload ) ),
        ] );

        $config = self::$baseConfig + [ 'guzzle_options' => [ 'handler' => HandlerStack::create($mock) ] ];
        $_GET['code'] = uniqid();

        $auth0 = new Auth0( $config );

        $this->assertTrue( $auth0->exchange() );
        $this->assertEquals( $id_token_payload, $auth0->getUser() );
        $this->assertEquals( $id_token, $auth0->getIdToken() );
        $this->assertEquals( '1.2.3', $auth0->getAccessToken() );
    }

    /**
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function testThatExchangeSucceedsWithNoIdToken() {

        $mock = new MockHandler( [
            // Code exchange response.
            // Respond with no ID token, access token with correct number of segments.
            new Response( 200, self::$headers, '{"access_token":"1.2.3"}' ),
            // Userinfo response.
            new Response( 200, self::$headers, '{"sub":"123"}' ),
        ] );

        $config = self::$baseConfig + [ 'guzzle_options' => [ 'handler' => HandlerStack::create($mock) ] ];
        $_GET['code'] = uniqid();

        $auth0 = new Auth0( $config );

        $this->assertTrue( $auth0->exchange() );
        $this->assertEquals( ['sub' => '123'], $auth0->getUser() );
        $this->assertEquals( '1.2.3', $auth0->getAccessToken() );
    }
}
