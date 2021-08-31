<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Firebase\JWT\JWT;

/**
 * Class TokenGenerator.
 */
class TokenGenerator
{
    public const ALG_RS256 = 1;
    public const ALG_HS256 = 2;

    public const TOKEN_ID = 1;
    public const TOKEN_ACCESS = 2;

    protected static function getAccessTokenClaims(
        array $overrides
    ): array {
        $defaults = [
            'aud' => '__test_client_id__',
            'nonce' => '__test_nonce__',
            'auth_time' => time() - 100,
            'exp' => time() + 1000,
            'iat' => time() - 1000,
        ];

        return array_merge($defaults, $overrides);
    }

    protected static function getIdTokenClaims(
        array $overrides
    ): array {
        $defaults = [
            'sub' => '__test_sub__',
            'iss' => 'https://__test_domain__/',
            'aud' => '__test_client_id__',
            'nonce' => '__test_nonce__',
            'auth_time' => time() - 100,
            'exp' => time() + 1000,
            'iat' => time() - 1000,
            'azp' => '__test_azp__'
        ];

        return array_merge($defaults, $overrides);
    }

    public static function generateRsaKeyPair(): array
    {
        $privateKeyResource = openssl_pkey_new([
            'digest_alg' => 'sha256',
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ]);

        openssl_pkey_export($privateKeyResource, $privateKey);
        $publicKey = openssl_pkey_get_details($privateKeyResource);

        $resCsr = openssl_csr_new([], $privateKeyResource);
        $resCert = openssl_csr_sign($resCsr, null, $privateKeyResource, 30);
        openssl_x509_export($resCert, $x509);

        return [
            'private' => $privateKey,
            'public' => $publicKey['key'],
            'cert' => $x509,
        ];
    }

    public static function generateDsaKeyPair(): array
    {
        $privateKeyResource = openssl_pkey_new([
            'digest_alg' => 'sha256',
            'private_key_type' => OPENSSL_KEYTYPE_DSA,
        ]);

        openssl_pkey_export($privateKeyResource, $privateKey);
        $publicKey = openssl_pkey_get_details($privateKeyResource);

        $resCsr = openssl_csr_new([], $privateKeyResource);
        $resCert = openssl_csr_sign($resCsr, null, $privateKeyResource, 30);
        openssl_x509_export($resCert, $x509);

        return [
            'private' => $privateKey,
            'public' => $publicKey['key'],
            'cert' => $x509,
        ];
    }

    public static function withHs256(
        array $claims = [],
        string $key = '__test_client_secret__',
        $headers = []
    ): string {
        $claims = self::getIdTokenClaims($claims);
        return JWT::encode($claims, $key, 'HS256', null, $headers + ['alg' => 'HS256']);
    }

    public static function withRs256(
        array $claims = [],
        ?string $privateKey = null,
        $headers = []
    ): string {
        $claims = self::getIdTokenClaims($claims);

        if ($privateKey === null) {
            $rsaKeyPair = self::generateRsaKeyPair();
            $privateKey = $rsaKeyPair['private'];
        }

        return JWT::encode($claims, $privateKey, 'RS256', null, $headers + ['alg' => 'RS256']);
    }

    public static function decodePart(
        string $part,
        bool $json = true
    ) {
        $decoded = base64_decode(strtr($part, '-_', '+/'), true);

        if ($json) {
            return json_decode($decoded, true, 512, JSON_THROW_ON_ERROR);
        }

        return $decoded;
    }

    public static function create(
        int $tokenType = self::TOKEN_ID,
        int $algorithm = self::ALG_RS256,
        array $claims = [],
        array $headers = []
    ): TokenGeneratorResponse {
        $keys = null;

        if ($tokenType === self::TOKEN_ACCESS) {
            $claims = self::getAccessTokenClaims($claims);
        }

        if ($tokenType === self::TOKEN_ID) {
            $claims = self::getIdTokenClaims($claims);
        }

        if ($algorithm === self::ALG_RS256) {
            $keys = self::generateRsaKeyPair();
            $headers = array_merge(['kid' => '__test_kid__'], $headers);
            $token = self::withRs256($claims, $keys['private'], $headers);
            $keys['cert'] = trim(mb_substr($keys['cert'], strpos($keys['cert'], "\n")+1));
            $keys['cert'] = str_replace("\n", '', mb_substr($keys['cert'], 0, strrpos($keys['cert'], "\n")));
        }

        if ($algorithm === self::ALG_HS256) {
            $token = self::withHs256($claims, '__test_client_secret__', $headers);
        }

        [$headers, $claims, $signature] = explode('.', $token);
        $payload = join('.', [$headers, $claims]);
        $signature = (string) TokenGenerator::decodePart($signature, false);
        $claims = (array) TokenGenerator::decodePart($claims, true);
        $headers = (array) TokenGenerator::decodePart($headers, true);

        $response = new TokenGeneratorResponse();
        $response->algorithm = $algorithm;
        $response->keys = $keys;
        $response->token = $token;
        $response->payload = $payload;
        $response->signature = $signature;
        $response->headers = $headers;
        $response->claims = $claims;
        $response->jwks = 'https://test.auth0.com/.well-known/jwks.json';
        $response->cache = hash('sha256', 'https://test.auth0.com/.well-known/jwks.json');

        return $response;
    }

    public static function break(
        TokenGeneratorResponse $token
    ): TokenGeneratorResponse {
        return $token;
    }
}

class TokenGeneratorResponse extends \stdClass
{
    public int $algorithm;
    public ?array $keys;
    public string $token;
    public string $payload;
    public string $signature;
    public array $headers;
    public array $claims;
    public string $jwks;
    public string $cache;
}
