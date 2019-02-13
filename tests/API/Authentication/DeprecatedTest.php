<?php
namespace Auth0\Tests\API\Authentication;

use Auth0\SDK\API\Authentication;
use Auth0\Tests\API\ApiTests;

class DeprecatedTest extends ApiTests
{

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
}
