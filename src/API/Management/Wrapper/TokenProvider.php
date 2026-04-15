<?php

namespace Auth0\SDK\API\Management\Wrapper;

use Auth0\SDK\API\Management\Core\Client\HttpClientBuilder;
use Auth0\SDK\API\Management\Core\Json\JsonEncoder;
use InvalidArgumentException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Cache\CacheItemPoolInterface;
use RuntimeException;

/**
 * @internal Handles OAuth 2.0 client credentials token acquisition and caching.
 */
final class TokenProvider
{
    private ?string $accessToken = null;
    private ?float $expiresAt = null;

    private const EXPIRY_LEEWAY_SECONDS = 10;

    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;
    private string $cacheKey;

    public function __construct(
        private readonly string $domain,
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly string $audience,
        ?ClientInterface $httpClient = null,
        private readonly ?CacheItemPoolInterface $cache = null,
    ) {
        if ($domain === '') {
            throw new InvalidArgumentException('Domain must not be empty.');
        }
        if ($clientId === '') {
            throw new InvalidArgumentException('Client ID must not be empty.');
        }
        if ($clientSecret === '') {
            throw new InvalidArgumentException('Client secret must not be empty.');
        }
        if ($audience === '') {
            throw new InvalidArgumentException('Audience must not be empty.');
        }
        $this->httpClient = $httpClient ?? HttpClientBuilder::baseClient();
        $this->requestFactory = HttpClientBuilder::requestFactory();
        $this->streamFactory = HttpClientBuilder::streamFactory();
        $this->cacheKey = 'auth0_management_token_' . preg_replace('/[^a-zA-Z0-9_.]/', '_', $this->clientId);
    }

    public function getToken(): string
    {
        // Check PSR-6 cache first
        if ($this->cache !== null && $this->accessToken === null) {
            $item = $this->cache->getItem($this->cacheKey);
            if ($item->isHit()) {
                $cached = $item->get();
                if (is_string($cached) && $cached !== '') {
                    $this->accessToken = $cached;
                    // Set expiresAt far in the future; the cache pool handles TTL expiry
                    $this->expiresAt = microtime(true) + 86400.0;
                }
            }
        }

        if ($this->accessToken !== null && $this->expiresAt !== null && microtime(true) < $this->expiresAt) {
            return $this->accessToken;
        }

        $this->fetchToken();

        /** @var string */
        return $this->accessToken;
    }

    private function fetchToken(): void
    {
        $url = "https://{$this->domain}/oauth/token";

        $body = JsonEncoder::encode([
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'audience' => $this->audience,
        ]);

        $request = $this->requestFactory->createRequest('POST', $url)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($this->streamFactory->createStream($body));

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (\Throwable $e) {
            throw new RuntimeException("Failed to fetch access token from {$url}: {$e->getMessage()}", 0, $e);
        }

        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode >= 300) {
            throw new RuntimeException(
                "Failed to fetch access token: received HTTP {$statusCode} from {$url}."
            );
        }

        $body = (string) $response->getBody();
        $data = json_decode($body, true);

        if (!is_array($data) || !isset($data['access_token']) || !is_string($data['access_token'])) {
            throw new RuntimeException('Token response does not contain a valid access_token.');
        }

        $this->accessToken = $data['access_token'];

        $expiresIn = isset($data['expires_in']) && is_numeric($data['expires_in'])
            ? (float) $data['expires_in']
            : 3600.0;

        $this->expiresAt = microtime(true) + $expiresIn - self::EXPIRY_LEEWAY_SECONDS;

        // Store in PSR-6 cache
        if ($this->cache !== null) {
            $ttl = (int) max(0, $expiresIn - self::EXPIRY_LEEWAY_SECONDS);
            $item = $this->cache->getItem($this->cacheKey);
            $item->set($this->accessToken);
            $item->expiresAfter($ttl > 0 ? $ttl : null);
            $this->cache->save($item);
        }
    }
}
