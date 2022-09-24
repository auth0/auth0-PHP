<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\Store\CookieStore;

/**
 * Class MockDataset.
 */
class MockCrypto
{
    /**
     * Encrypt a string in a fashion compatible with CookieStore::encrypt()/CookieStore::decrypt()
     */
    public static function cookieCompatibleEncrypt(
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
