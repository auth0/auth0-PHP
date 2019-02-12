<?php
namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\API\ApiTests;

class AuthApiTest extends ApiTests
{

    public static $telemetry;

    public static $telemetryParam;

    public static function setUpBeforeClass()
    {
        $infoHeadersData = new InformationHeaders;
        $infoHeadersData->setCorePackage();

        self::$telemetry      = urlencode( $infoHeadersData->build() );
        self::$telemetryParam = 'auth0Client='.self::$telemetry;
    }

    public function testThatBasicAuthorizeLinkIsBuiltCorrectly()
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $authorize_url       = $api->get_authorize_link('code', 'https://example.com/cb');
        $authorize_url_parts = parse_url( $authorize_url );

        $this->assertEquals('https', $authorize_url_parts['scheme']);
        $this->assertEquals('test-domain.auth0.com', $authorize_url_parts['host']);
        $this->assertEquals('/authorize', $authorize_url_parts['path']);

        $authorize_url_query = explode( '&', $authorize_url_parts['query'] );
        $this->assertContains('redirect_uri=https%3A%2F%2Fexample.com%2Fcb', $authorize_url_query);
        $this->assertContains('response_type=code', $authorize_url_query);
        $this->assertContains('client_id=__test_client_id__', $authorize_url_query);
        $this->assertContains(self::$telemetryParam, $authorize_url_query);
        $this->assertNotContains('connection=', $authorize_url_parts['query']);
        $this->assertNotContains('state=', $authorize_url_parts['query']);
    }

    public function testThatAuthorizeLinkIncludesConnection()
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $authorize_url       = $api->get_authorize_link('code', 'https://example.com/cb', 'test-connection');
        $authorize_url_query = parse_url( $authorize_url, PHP_URL_QUERY );
        $authorize_url_query = explode( '&', $authorize_url_query );

        $this->assertContains('connection=test-connection', $authorize_url_query);
        $this->assertContains(self::$telemetryParam, $authorize_url_query);
    }

    public function testThatAuthorizeLinkIncludesState()
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $authorize_url       = $api->get_authorize_link('code', 'https://example.com/cb', null, '__test_state__');
        $authorize_url_query = parse_url( $authorize_url, PHP_URL_QUERY );
        $authorize_url_query = explode( '&', $authorize_url_query );

        $this->assertContains('state=__test_state__', $authorize_url_query);
        $this->assertContains(self::$telemetryParam, $authorize_url_query);
    }

    public function testThatAuthorizeLinkIncludesAdditionalParams()
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $additional_params   = [ 'param1' => 'value1' ];
        $authorize_url       = $api->get_authorize_link('code', 'https://example.com/cb', null, null, $additional_params);
        $authorize_url_query = parse_url( $authorize_url, PHP_URL_QUERY );
        $authorize_url_query = explode( '&', $authorize_url_query );

        $this->assertContains('param1=value1', $authorize_url_query);
        $this->assertContains(self::$telemetryParam, $authorize_url_query);
    }

    public function testAuthorizeWithRO()
    {
        $env = self::getEnv();

        $api = new Authentication($env['DOMAIN'], $env['APP_CLIENT_ID']);

        $response = $api->authorize_with_ro(
            'auth@test.com',
            '123456',
            'openid email',
            'Username-Password-Authentication'
        );

        $this->assertArrayHasKey('id_token', $response);
        $this->assertArrayHasKey('access_token', $response);
        $this->assertArrayHasKey('token_type', $response);
        $this->assertEquals('bearer', $response['token_type']);

        $userinfo = $api->userinfo($response['access_token']);

        $this->assertArrayHasKey('email', $userinfo);
        $this->assertArrayHasKey('email_verified', $userinfo);
        $this->assertArrayHasKey('sub', $userinfo);
        $this->assertEquals('german@auth0.com', $userinfo['email']);
        $this->assertEquals('auth0|58adc60b82b0ca0774643eef', $userinfo['user_id']);
    }

    public function testOauthToken()
    {
        $env = self::getEnv();

        $api = new Authentication($env['DOMAIN'], $env['NIC_ID'], $env['NIC_SECRET']);

        $token = $api->client_credentials(
            [
                'audience' => 'https://'.$env['DOMAIN'].'/api/v2/'
            ]
        );

        $this->assertArrayHasKey('access_token', $token);
        $this->assertArrayHasKey('token_type', $token);
        $this->assertEquals('bearer', strtolower($token['token_type']));
    }

    public function testImpersonation()
    {
        $env = self::getEnv();

        $api = new Authentication($env['DOMAIN'], $env['GLOBAL_CLIENT_ID'], $env['GLOBAL_CLIENT_SECRET']);

        $token = $api->client_credentials([]);

        $url = $api->impersonate(
            $token['access_token'],
            'facebook|1434903327',
            'oauth2',
            'auth0|56b110b8d9d327e705e1d2da',
            'ycynBrUeQUnFqNacG3GAsaTyDhG4h0qT',
            [ 'response_type' => 'code' ]
        );

        $this->assertStringStartsWith('https://'.$env['DOMAIN'], $url);
    }

    public function testThatBasicLogoutLinkIsBuiltCorrectly()
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $logout_link_parts = parse_url($api->get_logout_link());

        $this->assertEquals('https', $logout_link_parts['scheme']);
        $this->assertEquals('test-domain.auth0.com', $logout_link_parts['host']);
        $this->assertEquals('/v2/logout', $logout_link_parts['path']);
        $this->assertEquals(self::$telemetryParam, $logout_link_parts['query']);
    }

    public function testThatReturnToLogoutLinkIsBuiltCorrectly()
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $logout_link_query = parse_url($api->get_logout_link('https://example.com/return-to'), PHP_URL_QUERY);
        $logout_link_query = explode( '&', $logout_link_query );

        $this->assertContains('returnTo=https%3A%2F%2Fexample.com%2Freturn-to', $logout_link_query);
        $this->assertContains(self::$telemetryParam, $logout_link_query);
    }

    public function testThatClientIdLogoutLinkIsBuiltCorrectly()
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $logout_link_query = parse_url($api->get_logout_link(null, '__test_client_id__'), PHP_URL_QUERY);
        $logout_link_query = explode( '&', $logout_link_query );

        $this->assertContains('client_id='.'__test_client_id__', $logout_link_query);
        $this->assertContains(self::$telemetryParam, $logout_link_query);
    }

    public function testThatFederatedogoutLinkIsBuiltCorrectly()
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $logout_link_query = parse_url($api->get_logout_link(null, null, true), PHP_URL_QUERY);
        $logout_link_query = explode( '&', $logout_link_query );

        $this->assertContains('federated=', $logout_link_query);
        $this->assertContains(self::$telemetryParam, $logout_link_query);
    }
}
