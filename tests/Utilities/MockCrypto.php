<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\Store\CookieStore;

class MockCrypto
{
    /**
     * Encrypt a string in a fashion compatible with CookieStore v2 (aes-256-gcm + HKDF).
     */
    public static function cookieCompatibleEncrypt(
        string $secret,
        $data,
        ?string $overrideIv = null,
        ?string $overrideTag = null
    ): string {
        $algo = CookieStore::VAL_CRYPTO_ALGO_V2;
        $ivLength = openssl_cipher_iv_length($algo);
        $key = hash_hkdf('sha256', $secret, CookieStore::VAL_CRYPTO_KEY_LENGTH, 'auth0-php-cookie-encryption');

        $iv = $overrideIv ?? openssl_random_pseudo_bytes($ivLength);

        $encrypted = openssl_encrypt(json_encode($data), $algo, $key, 0, $iv, $tag);

        $data = json_encode([
            'v' => CookieStore::VAL_CRYPTO_VERSION,
            'tag' => base64_encode($overrideTag ?? $tag),
            'iv' => base64_encode($iv),
            'data' => $encrypted
        ]);

        if (! is_string($data)) {
            return '';
        }

        return rawurlencode($data);
    }

    /**
     * Encrypt a string using the legacy scheme (aes-128-gcm + raw key, no version marker).
     * Used for testing the backward-compatible fallback path.
     */
    public static function legacyCookieCompatibleEncrypt(
        string $secret,
        $data,
        ?string $overrideIv = null,
        ?string $overrideTag = null
    ): string {
        $ivLength = openssl_cipher_iv_length(CookieStore::VAL_CRYPTO_ALGO);

        $iv = $overrideIv ?? openssl_random_pseudo_bytes($ivLength);

        $encrypted = openssl_encrypt(json_encode($data), CookieStore::VAL_CRYPTO_ALGO, $secret, 0, $iv, $tag);

        $data = json_encode([
            'tag' => base64_encode($overrideTag ?? $tag),
            'iv' => base64_encode($iv),
            'data' => $encrypted
        ]);

        if (! is_string($data)) {
            return '';
        }

        return rawurlencode($data);
    }
}
