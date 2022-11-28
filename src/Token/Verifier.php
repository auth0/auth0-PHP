<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponse;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class Verifier.
 */
final class Verifier
{
    /**
     * Constructor for the Token Verifier class.
     *
     * @param  string  $payload  a string representing the headers and claims portions of a JWT
     * @param  string  $signature  a string representing the signature portion of a JWT
     * @param  array<int|string>  $headers  An array of the headers for the JWT. Expects an 'alg' header, and in the case of RS256, a 'kid' header.
     * @param  string|null  $algorithm  Optional. Algorithm to use for verification. Expects either RS256 or HS256. Defaults to RS256.
     * @param  string|null  $jwksUri  Optional. URI to the JWKS when verifying RS256 tokens.
     * @param  string|null  $clientSecret  Optional. Client Secret found in the Application settings for verifying HS256 tokens.
     * @param  int|null  $cacheExpires  Optional. Time in seconds to keep JWKS records cached.
     * @param  CacheItemPoolInterface|null  $cache  Optional. A PSR-6 CacheItemPoolInterface instance to cache JWKS results within.
     * @param  array<object>|null  $mockedHttpResponses  Optional. Only intended for unit testing purposes.
     */
    public function __construct(
        private SdkConfiguration $configuration,
        private string $payload,
        private string $signature,
        private array $headers,
        private ?string $algorithm = null,
        private ?string $jwksUri = null,
        private ?string $clientSecret = null,
        private ?int $cacheExpires = null,
        private ?CacheItemPoolInterface $cache = null,
        private ?array &$mockedHttpResponses = null,
    ) {
        $this->verify();
    }

    /**
     * Verify the token signature.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When signature verification fails. See exception message for details.
     *
     * @psalm-suppress PossiblyInvalidArgument
     */
    public function verify(): self
    {
        $alg = $this->headers['alg'] ?? null;

        if (null === $alg) {
            throw \Auth0\SDK\Exception\InvalidTokenException::missingAlgHeader();
        }

        if (null !== $this->algorithm && $this->algorithm !== $alg) {
            throw \Auth0\SDK\Exception\InvalidTokenException::unexpectedSigningAlgorithm($this->algorithm, (string) $alg);
        }

        if (Token::ALGO_RS256 === $alg) {
            $kid = $this->headers['kid'] ?? null;

            if (null === $kid) {
                throw \Auth0\SDK\Exception\InvalidTokenException::missingKidHeader();
            }

            $key = $this->getKey((string) $kid);
            $valid = openssl_verify($this->payload, $this->signature, $key, OPENSSL_ALGO_SHA256);
            $this->freeKey($key);

            if (1 !== $valid) {
                throw \Auth0\SDK\Exception\InvalidTokenException::badSignature();
            }

            return $this;
        }

        if (Token::ALGO_HS256 === $alg) {
            if (null === $this->clientSecret) {
                throw \Auth0\SDK\Exception\InvalidTokenException::requiresClientSecret();
            }

            $hash = hash_hmac('sha256', $this->payload, $this->clientSecret, true);
            $valid = hash_equals($this->signature, $hash);

            if (! $valid) {
                throw \Auth0\SDK\Exception\InvalidTokenException::badSignature();
            }

            return $this;
        }

        throw \Auth0\SDK\Exception\InvalidTokenException::unsupportedSigningAlgorithm((string) $alg);
    }

    /**
     * Query a JWKS endpoint and return an array representing the key set.
     *
     * @param  string|null  $expectsKid  Optional. A key id we're currently expecting to retrieve. When retrieving a cache response, if the key isn't present, it will invalid the cache and fetch an updated JWKS.
     * @return array<int|string, mixed>
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when the JWKS uri is not properly configured, or is unreachable
     */
    private function getKeySet(
        ?string $expectsKid = null,
    ): array {
        if (null === $this->jwksUri) {
            throw \Auth0\SDK\Exception\InvalidTokenException::requiresJwksUri();
        }

        $jwksCacheKey = hash('sha256', $this->jwksUri);
        $jwksUri = parse_url($this->jwksUri);

        // @phpstan-ignore-next-line
        if (! $jwksCacheKey || ! \is_array($jwksUri)) {
            return [];
        }

        $scheme = $jwksUri['scheme'] ?? 'https';
        $path = $jwksUri['path'] ?? '/.well-known/jwks.json';
        $host = $jwksUri['host'] ?? $this->configuration->getDomain() ?? '';
        $item = null;

        $response = [];

        if (null !== $this->cache) {
            $item = $this->cache->getItem($jwksCacheKey);

            if ($item->isHit()) {
                /** @var array<mixed> $value */
                $value = $item->get();

                if (null === $expectsKid || isset($value[$expectsKid])) {
                    return $value;
                }
            }
        }

        $keys = (new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', $path, [], $scheme . '://' . $host, $this->mockedHttpResponses))->call();

        if (HttpResponse::wasSuccessful($keys)) {
            try {
                $keys = HttpResponse::decodeContent($keys);
            } catch (\Throwable $throwable) {
                return [];
            }

            if (\is_array($keys) && isset($keys['keys']) && 0 !== \count($keys['keys'])) {
                foreach ($keys['keys'] as $key) {
                    if (isset($key['kid'], $key['x5c']) && \is_array($key['x5c']) && [] !== $key['x5c']) {
                        $response[(string) $key['kid']] = $key;
                    }
                }
            }

            if ([] !== $response && null !== $this->cache && null !== $item) {
                $item->set($response);
                $item->expiresAfter($this->cacheExpires ?? 60);
                $this->cache->save($item);
            }
        }

        return $response;
    }

    /**
     * Query a JWKS endpoint for a matching key. Parse and return a OpenSSLAsymmetricKey (PHP 8.0+) or resource (PHP < 8.0) suitable for verification.
     *
     * @param  string  $kid  the 'kid' header value to use for key lookup
     * @return \OpenSSLAsymmetricKey|resource
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When unable to retrieve key. See error message for details.
     *
     * @psalm-suppress UndefinedDocblockClass
     */
    private function getKey(
        string $kid,
    ) {
        /** @var array<array{x5c: array<int|string>}> $keys */
        $keys = $this->getKeySet($kid);

        if (! isset($keys[$kid])) {
            throw \Auth0\SDK\Exception\InvalidTokenException::badSignatureMissingKid();
        }

        $key = openssl_pkey_get_public("-----BEGIN CERTIFICATE-----\n" . chunk_split((string) $keys[$kid]['x5c'][0], 64, "\n") . '-----END CERTIFICATE-----');

        if (\is_bool($key)) {
            throw \Auth0\SDK\Exception\InvalidTokenException::badSignature();
        }

        $details = openssl_pkey_get_details($key);

        if (false === $details || OPENSSL_KEYTYPE_RSA !== $details['type']) {
            throw \Auth0\SDK\Exception\InvalidTokenException::badSignatureIncompatibleAlgorithm();
        }

        return $key;
    }

    /**
     * Free key resource in PHP <8.0.
     *
     * @param  mixed  $key  An instance of OpenSSLAsymmetricKey (PHP 8.0+) or 'resource' (PHP <8.0).
     *
     * @codeCoverageIgnore
     */
    private function freeKey(
        $key,
    ): void {
        /*
         * openssl_free_key is deprecated in PHP 8.0, so avoid calling it there:
         *
         * @psalm-suppress UndefinedClass
         */
        if ($key instanceof \OpenSSLAsymmetricKey) {
            return;
        }

        /*
         * TODO: Remove when PHP 7.x support is EOL
         *
         * @psalm-suppress MixedArgument
         */
        openssl_free_key($key); // phpcs:ignore
    }
}
