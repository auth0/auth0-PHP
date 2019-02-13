<?php
namespace Auth0\Tests\API\Authentication;

use Auth0\SDK\API\Authentication;
use Auth0\Tests\API\ApiTests;

class ClientCredentialsTest extends ApiTests
{

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
}
