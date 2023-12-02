<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use const OPENSSL_ALGO_SHA256;
use const OPENSSL_ALGO_SHA384;
use const OPENSSL_ALGO_SHA512;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token;
use Auth0\SDK\Utility\{HttpClient, HttpRequest, HttpResponse};
use OpenSSLAsymmetricKey;
use Psr\Cache\{CacheItemInterface, CacheItemPoolInterface};
use Throwable;

use function count;
use function is_array;
use function is_bool;

final class Verifier
{
    /**
     * Constructor for the Token Verifier class.
     *
     * @param SdkConfiguration            $configuration       SDK configuration options.
     * @param string                      $payload             a string representing the headers and claims portions of a JWT
     * @param string                      $signature           a string representing the signature portion of a JWT
     * @param array<int|string>           $headers             An array of the headers for the JWT. Expects an 'alg' header, and in the case of RS256, a 'kid' header.
     * @param null|string                 $algorithm           Optional. Algorithm to use for verification. Expects either RS256 or HS256. Defaults to RS256.
     * @param null|string                 $jwksUri             Optional. URI to the JWKS when verifying RS256 tokens.
     * @param null|string                 $clientSecret        Optional. Client Secret found in the Application settings for verifying HS256 tokens.
     * @param null|int                    $cacheExpires        Optional. Time in seconds to keep JWKS records cached.
     * @param null|CacheItemPoolInterface $cache               Optional. A PSR-6 CacheItemPoolInterface instance to cache JWKS results within.
     * @param null|array<object>          $mockedHttpResponses Optional. Only intended for unit testing purposes.
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

        $usesHmac = match ($alg) {
            Token::ALGO_HS256, Token::ALGO_HS384, Token::ALGO_HS512 => true,
            default => false,
        };

        if ($usesHmac) {
            if (null === $this->clientSecret) {
                throw \Auth0\SDK\Exception\InvalidTokenException::requiresClientSecret();
            }

            $digest = match ($alg) {
                Token::ALGO_HS256 => 'sha256',
                Token::ALGO_HS384 => 'sha384',
                Token::ALGO_HS512 => 'sha512',
                default => throw \Auth0\SDK\Exception\InvalidTokenException::unsupportedSigningAlgorithm((string) $alg),
            };

            $hash = hash_hmac($digest, $this->payload, $this->clientSecret, true);
            $valid = hash_equals($hash, $this->signature);

            if (! $valid) {
                throw \Auth0\SDK\Exception\InvalidTokenException::badSignature();
            }

            return $this;
        }

        $usesRsa = match ($alg) {
            Token::ALGO_RS256, Token::ALGO_RS384, Token::ALGO_RS512 => true,
            default => false,
        };

        if ($usesRsa) {
            $digest = match ($alg) {
                Token::ALGO_RS256 => OPENSSL_ALGO_SHA256,
                Token::ALGO_RS384 => OPENSSL_ALGO_SHA384,
                Token::ALGO_RS512 => OPENSSL_ALGO_SHA512,
                default => throw \Auth0\SDK\Exception\InvalidTokenException::unsupportedSigningAlgorithm((string) $alg),
            };

            $kid = $this->headers['kid'] ?? null;

            if (null === $kid) {
                throw \Auth0\SDK\Exception\InvalidTokenException::missingKidHeader();
            }

            $key = $this->getKey((string) $kid);
            $valid = openssl_verify($this->payload, $this->signature, $key, $digest);

            if (1 !== $valid) {
                throw \Auth0\SDK\Exception\InvalidTokenException::badSignature();
            }

            return $this;
        }

        throw \Auth0\SDK\Exception\InvalidTokenException::unsupportedSigningAlgorithm((string) $alg);
    }

    /**
     * Query a JWKS endpoint for a matching key. Parse and return a OpenSSLAsymmetricKey (PHP 8.0+) suitable for verification.
     *
     * @param string $kid the 'kid' header value to use for key lookup
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When unable to retrieve key. See error message for details.
     *
     * @psalm-suppress UndefinedDocblockClass
     */
    private function getKey(
        string $kid,
    ): OpenSSLAsymmetricKey {
        /** @var array<array{x5c: array<int|string>}> $keys */
        $keys = $this->getKeySet($kid);

        if (! isset($keys[$kid])) {
            throw \Auth0\SDK\Exception\InvalidTokenException::badSignatureMissingKid();
        }

        $key = openssl_pkey_get_public("-----BEGIN CERTIFICATE-----\n" . chunk_split((string) $keys[$kid]['x5c'][0], 64, "\n") . '-----END CERTIFICATE-----');

        if (is_bool($key)) {
            throw \Auth0\SDK\Exception\InvalidTokenException::badSignature();
        }

        $details = openssl_pkey_get_details($key);

        if (false === $details || OPENSSL_KEYTYPE_RSA !== $details['type']) {
            throw \Auth0\SDK\Exception\InvalidTokenException::badSignatureIncompatibleAlgorithm();
        }

        return $key;
    }

    /**
     * Query a JWKS endpoint and return an array representing the key set.
     *
     * @param null|string $expectsKid Optional. A key id we're currently expecting to retrieve. When retrieving a cache response, if the key isn't present, it will invalid the cache and fetch an updated JWKS.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when the JWKS uri is not properly configured, or is unreachable
     *
     * @return array<int|string, mixed>
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
        if (! $jwksCacheKey || ! is_array($jwksUri)) {
            return [];
        }

        $scheme = $jwksUri['scheme'] ?? 'https';
        $path = $jwksUri['path'] ?? '/.well-known/jwks.json';
        $host = $jwksUri['host'] ?? $this->configuration->getDomain() ?? '';
        $item = null;

        $response = [];

        if ($this->cache instanceof CacheItemPoolInterface) {
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
            } catch (Throwable) {
                return [];
            }

            if (is_array($keys) && isset($keys['keys']) && 0 !== count($keys['keys'])) {
                foreach ($keys['keys'] as $key) {
                    if (isset($key['kid'], $key['x5c']) && is_array($key['x5c']) && [] !== $key['x5c']) {
                        $response[(string) $key['kid']] = $key;
                    }
                }
            }

            if ([] !== $response && $item instanceof CacheItemInterface) {
                $item->set($response);
                $item->expiresAfter($this->cacheExpires ?? 60);
                $this->cache->save($item);
            }
        }

        return $response;
    }
}
