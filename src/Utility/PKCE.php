<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

/**
 * Class PKCE.
 */
final class PKCE
{
    /**
     * Generate a random string of between 43 and 128 characters containing
     * letters, numbers and "-", ".", "_", "~", as defined in the RFC 7636
     * specification.
     *
     * @param  int  $length  Code verifier length
     *
     * @see https://tools.ietf.org/html/rfc7636
     */
    public static function generateCodeVerifier(
        int $length = 43,
    ): string {
        if ($length < 43 || $length > 128) {
            throw \Auth0\SDK\Exception\ArgumentException::codeVerifierLength();
        }

        $string = '';

        while (($len = mb_strlen($string)) < $length) {
            $size = $length - $len;
            $size = $size >= 1 ? $size : 1;

            // @codeCoverageIgnoreStart
            try {
                $bytes = random_bytes($size);
            } catch (\Exception $exception) {
                $bytes = (string) openssl_random_pseudo_bytes($size);
            }
            // @codeCoverageIgnoreEnd

            $string .= mb_substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }

    /**
     * Returns the generated code challenge from the given code_verifier. The
     * code_challenge should be a Base64 encoded string with URL and
     * filename-safe characters. The trailing '=' characters should be removed
     * and no line breaks, whitespace, or other additional characters should be
     * present.
     *
     * @param  string  $codeVerifier  string to generate code challenge from
     *
     * @see https://auth0.com/docs/flows/concepts/auth-code-pkce
     */
    public static function generateCodeChallenge(
        string $codeVerifier,
    ): string {
        $encoded = base64_encode(hash('sha256', $codeVerifier, true));

        return strtr(rtrim($encoded, '='), '+/', '-_');
    }
}
