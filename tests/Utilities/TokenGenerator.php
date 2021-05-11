<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Firebase\JWT\JWT;

/**
 * Class TokenGenerator.
 */
class TokenGenerator
{
    protected static function getClaims(
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
        $public_key = openssl_pkey_get_details($privateKeyResource);

        return [
            'private' => $privateKey,
            'public' => $public_key['key'],
        ];
    }

    public static function withHs256(
        array $claims = [],
        string $key = '__test_client_secret__',
        $headers = []
    ): string {
        $claims = self::getClaims($claims);
        return JWT::encode($claims, $key, 'HS256', null, $headers + ['alg' => 'HS256']);
    }

    public static function withRs256(
        array $claims = [],
        ?string $privateKey = null,
        $headers = []
        ): string {
        $claims = self::getClaims($claims);

        if ($privateKey === null) {
            $rsaKeyPair = self::generateRsaKeyPair();
            $privateKey = $rsaKeyPair['private'];
        }

        return JWT::encode($claims, $privateKey, 'RS256', null, $headers + ['alg' => 'RS256']);
    }
}
