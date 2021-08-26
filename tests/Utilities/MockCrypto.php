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
        string $data
    ): string {
        $ivLength = openssl_cipher_iv_length(CookieStore::VAL_CRYPTO_ALGO);
        $iv = openssl_random_pseudo_bytes($ivLength);
        $encrypted = openssl_encrypt($data, CookieStore::VAL_CRYPTO_ALGO, $secret, 0, $iv, $tag);
        $encrypted = json_encode(serialize([
            'tag' => base64_encode($tag),
            'iv' => base64_encode($iv),
            'data' => $encrypted
        ]), JSON_THROW_ON_ERROR);

        if ($encrypted === false) {
            return '';
        }

        return $encrypted;
    }
}
