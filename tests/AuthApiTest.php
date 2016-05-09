<?php
namespace Auth0\Tests;

use Auth0\SDK\Auth0AuthApi;

class AuthApiTest extends ApiTests {

    public function testAuthorize() {

        $domain = 'dummy.auth0.com';
        $client_id = '123456';

        $api = new Auth0AuthApi($domain, $client_id);

        $authorize_url = $api->get_authorize_link('code', 'http://lala.com');

        $this->assertEquals("https://dummy.auth0.com/authorize?response_type=code&redirect_uri=http://lala.com&client_id=123456", $authorize_url);

        $authorize_url2 = $api->get_authorize_link('token', 'http://lala.com', 'facebook', 'dastate');

        $this->assertEquals("https://dummy.auth0.com/authorize?response_type=token&redirect_uri=http://lala.com&client_id=123456&connection=facebook&state=dastate", $authorize_url2);
    }

    public function testAuthorizeWithRO() {
        $env = $this->getEnv();
        
        $api = new Auth0AuthApi($env['DOMAIN'], $env['APP_CLIENT_ID']);

        $response = $api->authorize_with_ro('auth@test.com', '123456', 'openid', 'Username-Password-Authentication');

        $this->assertArrayHasKey('id_token', $response);
        $this->assertArrayHasKey('access_token', $response);
        $this->assertArrayHasKey('token_type', $response);
        $this->assertEquals('bearer', $response['token_type']);

        $userinfo = $api->userinfo($response['access_token']);

        $this->assertArrayHasKey('email', $userinfo);
        $this->assertArrayHasKey('email_verified', $userinfo);
        $this->assertArrayHasKey('user_id', $userinfo);
        $this->assertEquals('auth@test.com', $userinfo['email']);
        $this->assertEquals('auth0|5730970e4518a40b60170e0f', $userinfo['user_id']);

        $tokeninfo = $api->tokeninfo($response['id_token']);

        $this->assertArrayHasKey('email', $tokeninfo);
        $this->assertArrayHasKey('email_verified', $tokeninfo);
        $this->assertArrayHasKey('user_id', $tokeninfo);
        $this->assertEquals('auth@test.com', $tokeninfo['email']);
        $this->assertEquals('auth0|5730970e4518a40b60170e0f', $tokeninfo['user_id']);
    }

    public function testOauthToken() {
        $env = $this->getEnv();
        
        $api = new Auth0AuthApi($env['DOMAIN'], $env['GLOBAL_CLIENT_ID'], $env['GLOBAL_CLIENT_SECRET']);

        $token = $api->get_access_token();

        $this->assertArrayHasKey('access_token', $token);
        $this->assertArrayHasKey('token_type', $token);
        $this->assertEquals('bearer', strtolower($token['token_type']));
    }
}