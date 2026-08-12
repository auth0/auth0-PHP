<?php

namespace Auth0\SDK\API\Management\Wrapper;

use Psr\Http\Client\ClientInterface;
use Psr\Cache\CacheItemPoolInterface;

final class ManagementClientOptions
{
    /**
     * @var mixed Token provider callable stored as mixed for PHPStan compatibility.
     */
    private mixed $tokenProviderFn;

    /**
     * @param string $domain Tenant domain, e.g. "tenant.auth0.com".
     * @param ?string $token Static access token.
     * @param ?callable $tokenProvider Callable that returns a token string.
     * @param ?string $clientId Client ID for client credentials grant.
     * @param ?string $clientSecret Client secret for client credentials grant.
     * @param ?string $audience API audience. Defaults to https://{domain}/api/v2/.
     * @param ?ClientInterface $httpClient Custom Guzzle HTTP client.
     * @param ?float $timeout Request timeout in seconds.
     * @param ?int $maxRetries Maximum number of request retries.
     * @param ?array<string, string> $additionalHeaders Extra headers to include in requests.
     * @param ?CacheItemPoolInterface $tokenCache PSR-6 cache pool for persisting management tokens.
     */
    public function __construct(
        public readonly string $domain,
        public readonly ?string $token = null,
        ?callable $tokenProvider = null,
        public readonly ?string $clientId = null,
        public readonly ?string $clientSecret = null,
        public readonly ?string $audience = null,
        public readonly ?ClientInterface $httpClient = null,
        public readonly ?float $timeout = null,
        public readonly ?int $maxRetries = null,
        public readonly ?array $additionalHeaders = null,
        public readonly ?CacheItemPoolInterface $tokenCache = null,
    ) {
        $this->tokenProviderFn = $tokenProvider;
    }

    /**
     * @return ?(callable(): string)
     */
    public function getTokenProvider(): ?callable
    {
        $fn = $this->tokenProviderFn;
        if ($fn === null) {
            return null;
        }
        /** @var callable(): string */
        return $fn;
    }
}
