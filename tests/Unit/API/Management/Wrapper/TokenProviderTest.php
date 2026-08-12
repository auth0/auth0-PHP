<?php

namespace Auth0\Tests\Unit\API\Management\Wrapper;

use Auth0\SDK\API\Management\Wrapper\TokenProvider;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class TokenProviderTest extends TestCase
{
    public function testValidConstruction(): void
    {
        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
        );

        $this->assertInstanceOf(TokenProvider::class, $provider);
    }

    public function testEmptyDomainThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Domain must not be empty.');

        new TokenProvider(
            domain: '',
            clientId: 'client-id',
            clientSecret: 'client-secret',
            audience: 'https://example.com/api/v2/',
        );
    }

    public function testEmptyClientIdThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Client ID must not be empty.');

        new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: '',
            clientSecret: 'client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
        );
    }

    public function testEmptyClientSecretThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Client secret must not be empty.');

        new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'client-id',
            clientSecret: '',
            audience: 'https://tenant.auth0.com/api/v2/',
        );
    }

    public function testEmptyAudienceThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Audience must not be empty.');

        new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'client-id',
            clientSecret: 'client-secret',
            audience: '',
        );
    }

    public function testGetTokenFetchesFromEndpoint(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode([
                'access_token' => 'fetched-token-123',
                'token_type' => 'Bearer',
                'expires_in' => 86400,
            ])),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
        );

        $token = $provider->getToken();
        $this->assertEquals('fetched-token-123', $token);
    }

    public function testTokenIsCachedOnSecondCall(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode([
                'access_token' => 'cached-token',
                'expires_in' => 86400,
            ])),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
        );

        $token1 = $provider->getToken();
        $token2 = $provider->getToken();

        $this->assertEquals('cached-token', $token1);
        $this->assertEquals('cached-token', $token2);
        // MockHandler should have no remaining requests (only 1 was made)
        $this->assertEquals(0, $mockHandler->count());
    }

    public function testExpiredTokenTriggersRefetch(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode([
                'access_token' => 'first-token',
                'expires_in' => 0, // Will expire immediately (leeway makes it negative)
            ])),
            new Response(200, [], json_encode([
                'access_token' => 'second-token',
                'expires_in' => 86400,
            ])),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
        );

        $token1 = $provider->getToken();
        $this->assertEquals('first-token', $token1);

        // Second call should re-fetch because expires_in=0 minus 10s leeway = already expired
        $token2 = $provider->getToken();
        $this->assertEquals('second-token', $token2);
        $this->assertEquals(0, $mockHandler->count());
    }

    public function testHttpErrorThrowsRuntimeException(): void
    {
        $mockHandler = new MockHandler([
            new \GuzzleHttp\Exception\RequestException(
                'Connection refused',
                new \GuzzleHttp\Psr7\Request('POST', 'https://tenant.auth0.com/oauth/token'),
            ),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to fetch access token');
        $provider->getToken();
    }

    public function testMissingAccessTokenInResponseThrows(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode([
                'token_type' => 'Bearer',
                'expires_in' => 86400,
            ])),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Token response does not contain a valid access_token.');
        $provider->getToken();
    }

    public function testNonJsonResponseThrows(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], 'not json'),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Token response does not contain a valid access_token.');
        $provider->getToken();
    }

    public function testDefaultExpiresInWhenNotInResponse(): void
    {
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode([
                'access_token' => 'no-expiry-token',
            ])),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
        );

        $token = $provider->getToken();
        $this->assertEquals('no-expiry-token', $token);

        // Second call should use cache (default 3600s expiry)
        $token2 = $provider->getToken();
        $this->assertEquals('no-expiry-token', $token2);
    }

    public function testTokenIsStoredInPsr6CacheAfterFetch(): void
    {
        $cache = new ArrayAdapter();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode([
                'access_token' => 'psr6-token',
                'expires_in' => 86400,
            ])),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
            cache: $cache,
        );

        $token = $provider->getToken();
        $this->assertEquals('psr6-token', $token);

        // Verify the token is in the PSR-6 cache
        $cacheItem = $cache->getItem('auth0_management_token_my_client_id');
        $this->assertTrue($cacheItem->isHit());
        $this->assertEquals('psr6-token', $cacheItem->get());
    }

    public function testTokenIsLoadedFromPsr6CacheWithoutHttpRequest(): void
    {
        $cache = new ArrayAdapter();

        // Pre-populate the cache
        $cacheItem = $cache->getItem('auth0_management_token_my_client_id');
        $cacheItem->set('cached-psr6-token');
        $cacheItem->expiresAfter(3600);
        $cache->save($cacheItem);

        // No HTTP responses queued — any HTTP call would throw
        $mockHandler = new MockHandler([]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
            cache: $cache,
        );

        $token = $provider->getToken();
        $this->assertEquals('cached-psr6-token', $token);

        // Second call also uses cache, no HTTP
        $token2 = $provider->getToken();
        $this->assertEquals('cached-psr6-token', $token2);
    }

    public function testExpiredPsr6CacheItemTriggersRefetch(): void
    {
        // Use a 0-second lifetime so the item expires immediately
        $cache = new ArrayAdapter(defaultLifetime: 0, storeSerialized: false);

        // Pre-populate with an expired item
        $cacheItem = $cache->getItem('auth0_management_token_my_client_id');
        $cacheItem->set('expired-token');
        $cacheItem->expiresAfter(-1);
        $cache->save($cacheItem);

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode([
                'access_token' => 'fresh-token',
                'expires_in' => 86400,
            ])),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $provider = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient,
            cache: $cache,
        );

        $token = $provider->getToken();
        $this->assertEquals('fresh-token', $token);
        $this->assertEquals(0, $mockHandler->count());
    }

    public function testPsr6CacheIsSharedAcrossProviderInstances(): void
    {
        $cache = new ArrayAdapter();

        // First provider fetches and caches the token
        $mockHandler1 = new MockHandler([
            new Response(200, [], json_encode([
                'access_token' => 'shared-token',
                'expires_in' => 86400,
            ])),
        ]);
        $handlerStack1 = HandlerStack::create($mockHandler1);
        $httpClient1 = new Client(['handler' => $handlerStack1]);

        $provider1 = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient1,
            cache: $cache,
        );

        $token1 = $provider1->getToken();
        $this->assertEquals('shared-token', $token1);

        // Second provider with same cache — no HTTP needed
        $mockHandler2 = new MockHandler([]);
        $handlerStack2 = HandlerStack::create($mockHandler2);
        $httpClient2 = new Client(['handler' => $handlerStack2]);

        $provider2 = new TokenProvider(
            domain: 'tenant.auth0.com',
            clientId: 'my-client-id',
            clientSecret: 'my-client-secret',
            audience: 'https://tenant.auth0.com/api/v2/',
            httpClient: $httpClient2,
            cache: $cache,
        );

        $token2 = $provider2->getToken();
        $this->assertEquals('shared-token', $token2);
    }
}
