<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\API\Helpers\RequestBuilder;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Token;
use Psr\SimpleCache\CacheInterface;

/**
 * Class Verifier.
 */
class Verifier
{
    protected string $payload;
    protected array $headers;
    protected ?string $clientSecret;
    protected ?string $algorithm;
    protected ?string $jwksUri;
    protected ?int $cacheExpires;
    protected ?CacheInterface $cache;

    public function __construct(
        string $payload,
        string $signature,
        array $headers,
        ?string $algorithm = null,
        ?string $jwksUri = null,
        ?string $clientSecret = null,
        ?int $cacheExpires = null,
        ?CacheInterface $cache = null
    ) {
        $this->payload = $payload;
        $this->signature = $signature;
        $this->headers = $headers;
        $this->algorithm = $algorithm;
        $this->jwksUri = $jwksUri;
        $this->clientSecret = $clientSecret;
        $this->cacheExpires = $cacheExpires;
        $this->cache = $cache;
    }

    public function verify(): self
    {
        $alg = $this->headers['alg'] ?? null;

        if ($this->algorithm && ($this->algorithm !== $alg)) {
            throw InvalidTokenException::unexpectedSigningAlgorithm($this->algorithm, $alg);
        }

        if ($alg === Token::ALGO_RS256) {
            $kid = $this->headers['kid'] ?? null;

            if ($kid === null) {
                throw InvalidTokenException::missingKidHeader();
            }

            $key = $this->getKey($kid);
            $valid = openssl_verify($this->payload, $this->signature, $key, OPENSSL_ALGO_SHA256);
            $this->freeKey($key);

            if ($valid !== 1) {
                throw InvalidTokenException::badSignature();
            }

            return $this;
        }

        if ($alg === Token::ALGO_HS256) {
            if (! $this->clientSecret) {
                throw InvalidTokenException::requiresClientSecret();
            }

            $hash = hash_hmac('sha256', $this->payload, $this->clientSecret, true);
            $valid = hash_equals($this->signature, $hash);

            if (! $valid) {
                throw InvalidTokenException::badSignature();
            }

            return $this;
        }

        throw InvalidTokenException::unsupportedSigningAlgorithm($alg);
    }

    protected function getKeySet(): array
    {
        if ($this->jwksUri === null) {
            throw InvalidTokenException::requiresJwksUri();
        }

        $jwksCacheKey = md5($this->jwksUri);
        $jwksUri = parse_url($this->jwksUri);

        $scheme = $jwksUri['scheme'] ?? 'https';
        $path = $jwksUri['path'] ?? '/.well-known/jwks.json';
        $response = [];

        if ($this->cache !== null) {
            $cached = $this->cache->get($jwksCacheKey);

            if ($cached !== null) {
                return $cached;
            }
        }

        $keys = (new RequestBuilder([
            'method' => 'get',
            'domain' => $scheme . '://' . $jwksUri['host'],
            'basePath' => $path,
        ]))->call();

        if (is_array($keys) && isset($keys['keys']) && count($keys['keys'])) {
            foreach ($keys['keys'] as $key) {
                if (isset($key['kid']) && isset($key['x5c']) && is_array($key['x5c']) && count($key['x5c'])) {
                    $response[$key['kid']] = $key;
                }
            }
        }

        if (count($response) && $this->cache !== null) {
            $this->cache->set($jwksCacheKey, $response, $this->cacheExpires ?? 60);
        }

        return $response;
    }

    protected function getKey(
        string $kid
    ) {
        $keys = $this->getKeySet();

        if (! isset($keys[$kid])) {
            throw InvalidTokenException::badSignatureMissingKid();
        }

        $key = openssl_pkey_get_public("-----BEGIN CERTIFICATE-----\n" . chunk_split($keys[$kid]['x5c'][0], 64, "\n") . '-----END CERTIFICATE-----');

        if (is_bool($key)) {
            throw InvalidTokenException::badSignature();
        }

        $details = openssl_pkey_get_details($key);

        if ($details['type'] !== OPENSSL_KEYTYPE_RSA) {
            throw InvalidTokenException::badSignatureIncompatibleAlgorithm();
        }

        return $key;
    }

    protected function freeKey(
        $key
    ): void {
        // openssl_free_key is deprecated in PHP 8.0, so avoid calling it there:
        if ($key instanceof \OpenSSLAsymmetricKey) {
            return;
        }

        // TODO: Remove when PHP 7.x support is EOL
        openssl_free_key($key);
    }
}
