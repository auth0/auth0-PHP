<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers;

/**
 * Class PKCE
 *
 * @package Auth0\SDK\Helpers
 */
class PKCE
{
    /**
     * Generate a random string of between 43 and 128 characters containing
     * letters, numbers and "-", ".", "_", "~", as defined in the RFC 7636
     * specification.
     *
     * @param int $length Code verifier length
     *
     * @return string
     *
     * @see https://tools.ietf.org/html/rfc7636
     */
    public static function generateCodeVerifier(int $length = 43): string
    {
        if ($length < 43 || $length > 128) {
            throw new \InvalidArgumentException(
                'Code verifier must be created with a minimum length of 43 characters and a maximum length of 128 characters.'
            );
        }

        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            try {
                $bytes = random_bytes($size);
            } catch (\Exception $e) {
                $bytes = openssl_random_pseudo_bytes($size);
            }

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
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
     * @param string $code_verifier
     *
     * @return string
     *
     * @see https://auth0.com/docs/flows/concepts/auth-code-pkce
     */
    public static function generateCodeChallenge(string $code_verifier): string
    {
        $encoded = base64_encode(hash('sha256', $code_verifier, true));

        return strtr(rtrim($encoded, '='), '+/', '-_');
    }
}
