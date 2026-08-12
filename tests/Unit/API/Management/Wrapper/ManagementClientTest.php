<?php

namespace Auth0\Tests\Unit\API\Management\Wrapper;

use Auth0\SDK\API\Management\Actions\ActionsClient;
use Auth0\SDK\API\Management\Users\UsersClient;
use Auth0\SDK\API\Management\Roles\RolesClient;
use Auth0\SDK\API\Management\Connections\ConnectionsClient;
use Auth0\SDK\API\Management\Wrapper\ManagementClient;
use Auth0\SDK\API\Management\Wrapper\ManagementClientOptions;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class ManagementClientTest extends TestCase
{
    public function testConstructWithStaticToken(): void
    {
        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            token: 'my-static-token',
        );

        $client = new ManagementClient($options);
        $this->assertInstanceOf(ManagementClient::class, $client);
    }

    public function testConstructWithTokenProvider(): void
    {
        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            tokenProvider: fn (): string => 'dynamic-token',
        );

        $client = new ManagementClient($options);
        $this->assertInstanceOf(ManagementClient::class, $client);
    }

    public function testConstructWithClientCredentials(): void
    {
        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
        );

        $client = new ManagementClient($options);
        $this->assertInstanceOf(ManagementClient::class, $client);
    }

    public function testThrowsWhenNoAuthProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('At least one of token, tokenProvider, or clientId+clientSecret must be provided.');

        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
        );

        new ManagementClient($options);
    }

    public function testThrowsWhenOnlyClientIdProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Both clientId and clientSecret must be provided together.');

        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
        );

        new ManagementClient($options);
    }

    public function testThrowsWhenOnlyClientSecretProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Both clientId and clientSecret must be provided together.');

        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            clientSecret: 'my-client-secret',
        );

        new ManagementClient($options);
    }

    public function testSubClientAccessViaGet(): void
    {
        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            token: 'test-token',
        );

        $client = new ManagementClient($options);

        $this->assertInstanceOf(UsersClient::class, $client->users);
        $this->assertInstanceOf(RolesClient::class, $client->roles);
        $this->assertInstanceOf(ActionsClient::class, $client->actions);
        $this->assertInstanceOf(ConnectionsClient::class, $client->connections);
    }

    public function testIssetDelegatesToManagement(): void
    {
        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            token: 'test-token',
        );

        $client = new ManagementClient($options);

        $this->assertTrue(isset($client->users));
        $this->assertTrue(isset($client->roles));
        $this->assertFalse(isset($client->nonExistentProperty));
    }

    public function testStaticTokenAppearsInRequestHeaders(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], '{}'),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            token: 'my-test-token',
            httpClient: $httpClient,
        );

        $client = new ManagementClient($options);
        $client->users->get('auth0|123');

        $lastRequest = $mockHandler->getLastRequest();
        $this->assertInstanceOf(RequestInterface::class, $lastRequest);
        $this->assertEquals('Bearer my-test-token', $lastRequest->getHeaderLine('Authorization'));
    }

    public function testTokenProviderIsInvokedOnRequest(): void
    {
        $callCount = 0;
        $tokenProvider = function () use (&$callCount): string {
            $callCount++;
            return 'provider-token-' . $callCount;
        };

        $mockHandler = new MockHandler([
            new Response(200, [], '{}'),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            tokenProvider: $tokenProvider,
            httpClient: $httpClient,
        );

        $client = new ManagementClient($options);
        $client->users->get('auth0|123');

        $this->assertGreaterThanOrEqual(1, $callCount);

        $lastRequest = $mockHandler->getLastRequest();
        $this->assertInstanceOf(RequestInterface::class, $lastRequest);
        $this->assertStringStartsWith('Bearer provider-token-', $lastRequest->getHeaderLine('Authorization'));
    }

    public function testTokenProviderHasPriorityOverStaticToken(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], '{}'),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            token: 'static-token',
            tokenProvider: fn (): string => 'provider-token',
            httpClient: $httpClient,
        );

        $client = new ManagementClient($options);
        $client->users->get('auth0|123');

        $lastRequest = $mockHandler->getLastRequest();
        $this->assertInstanceOf(RequestInterface::class, $lastRequest);
        $this->assertEquals('Bearer provider-token', $lastRequest->getHeaderLine('Authorization'));
    }

    public function testAdditionalHeadersAreIncluded(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], '{}'),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            token: 'test-token',
            httpClient: $httpClient,
            additionalHeaders: ['X-Custom' => 'custom-value'],
        );

        $client = new ManagementClient($options);
        $client->users->get('auth0|123');

        $lastRequest = $mockHandler->getLastRequest();
        $this->assertInstanceOf(RequestInterface::class, $lastRequest);
        $this->assertEquals('custom-value', $lastRequest->getHeaderLine('X-Custom'));
    }

    public function testTokenCachePassedThroughToTokenProvider(): void
    {
        $cache = new ArrayAdapter();

        // Pre-populate cache so that the TokenProvider reads from cache
        // and never makes an HTTP call for the token.
        $cacheItem = $cache->getItem('auth0_management_token_my_client_id');
        $cacheItem->set('cached-cc-token');
        $cacheItem->expiresAfter(3600);
        $cache->save($cacheItem);

        // Only need one response for the actual API call
        $mockHandler = new MockHandler([
            new Response(200, [], '{}'),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $options = new ManagementClientOptions(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            httpClient: $httpClient,
            tokenCache: $cache,
        );

        $client = new ManagementClient($options);
        $client->users->get('auth0|123');

        // Verify the cached token was used in the Authorization header
        $lastRequest = $mockHandler->getLastRequest();
        $this->assertInstanceOf(RequestInterface::class, $lastRequest);
        $this->assertEquals('Bearer cached-cc-token', $lastRequest->getHeaderLine('Authorization'));
    }
}
