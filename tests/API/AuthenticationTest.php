<?php

namespace Auth0\Tests\API;

use Auth0\SDK\API\Authentication;
use function GuzzleHttp\Psr7\parse_query;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Psr\Http\Message\RequestInterface;

class AuthenticationTest extends ApiTests
{

    /**
     * @param HttpClient $httpClient
     *
     * @return Authentication
     */
    private function getAuthenticationApi(HttpClient $httpClient)
    {
        return new Authentication(
            'token', 'cid', 'secret', 'audience', 'scope', new HttpMethodsClient($httpClient, MessageFactoryDiscovery::find())
        );
    }

    public function testLogin()
    {
        $httpClient = $this->getMockedHttpClientCallback(function(RequestInterface $request) {
            $body = json_decode($request->getBody()->__toString(), true);
            $this->assertEquals('user', $body['username']);
            $this->assertEquals('pass', $body['password']);
            $this->assertEquals('realm', $body['realm']);
            $this->assertEquals('scope', $body['scope']);
            $this->assertEquals('audience', $body['audience']);
            $this->assertEquals('cid', $body['client_id']);
            $this->assertEquals('secret', $body['client_secret']);
            $this->assertEquals('http://auth0.com/oauth/grant-type/password-realm', $body['grant_type']);

        });
        $api = $this->getAuthenticationApi($httpClient);
        $api->login('user', 'pass', 'realm', 'scope', 'audience');
    }

    public function testLoginWithDefaultDirectory()
    {
        $httpClient = $this->getMockedHttpClientCallback(function(RequestInterface $request) {
            $body = json_decode($request->getBody()->__toString(), true);
            $this->assertEquals('user', $body['username']);
            $this->assertEquals('pass', $body['password']);
            $this->assertEquals('scope', $body['scope']);
            $this->assertEquals('audience', $body['audience']);
            $this->assertEquals('cid', $body['client_id']);
            $this->assertEquals('secret', $body['client_secret']);
            $this->assertEquals('password', $body['grant_type']);

        });
        $api = $this->getAuthenticationApi($httpClient);
        $api->loginWithDefaultDirectory('user', 'pass', 'scope', 'audience');
    }
}