<?php

namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Mock\Client;

class BlacklistsTest extends BaseManagementTest
{
    public function testBlacklistAndGet()
    {
        $env = $this->getEnv();
        $token = $this->getToken($env, [
            'tokens' => [
                'actions' => ['blacklist'],
            ],
        ]);

        $this->domain = $env['DOMAIN'];

        $api = new Management($token, $env['DOMAIN']);

        $aud = $env['GLOBAL_CLIENT_ID'];
        $jti = 'somerandomJTI'.rand();

        $api->blacklists()->blacklist($aud, $jti);

        $all = $api->blacklists()->getAll($aud);

        $found = false;
        foreach ($all as $value) {
            if ($value['aud'] === $aud && $value['jti'] === $jti) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found, 'Blacklisted token not found');
    }

    public function testGetAll()
    {
        $httpClient = new Client();
        $httpClient->addResponse($this->createResponse('[
  {
    "aud": "foo",
    "jti": "bar"
  }
]'));
        $api = $this->getManagementApi($httpClient);
        $response = $api->blacklists()->getAll('foo');

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response[0]);
        $this->assertArrayHasKey('aud', $response[0]);
        $this->assertArrayHasKey('jti', $response[0]);
    }

    public function testBlacklist()
    {
        $httpClient = new Client();
        $httpClient->addResponse($this->createResponse(null, 204));
        $api = $this->getManagementApi($httpClient);
        $response = $api->blacklists()->blacklist('foo', 'bar');

        $this->assertEmpty($response);
    }

    /**
     * TODO we should get an exception here.
     */
    public function testBlacklistEmptyJti()
    {
        $httpClient = new Client();
        $httpClient->addResponse($this->createResponse(null, 400));
        $api = $this->getManagementApi($httpClient);
        $response = $api->blacklists()->blacklist('foo', '');

        // TODO remove this.
        $this->assertEmpty($response);
    }
}
