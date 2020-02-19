<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;

/**
 * Class IdTokenVerifier, an OIDC-compliant ID token verifier.
 *
 * @package Auth0\SDK\Helpers\Tokens
 */
final class IdTokenVerifier extends TokenVerifier
{
    /**
     * Verifies and decodes an OIDC-compliant ID token.
     *
     * @param string $token   Raw JWT string.
     * @param array  $options Options to adjust the verification. Can be:
     *      - "nonce" to check the nonce contained in the token (recommended).
     *      - "max_age" to check the auth_time of the token.
     *      - "leeway" clock tolerance in seconds for the current check only. See $leeway above for default.
     *
     * @return array
     *
     * @throws InvalidTokenException Thrown if:
     *      - ID token is missing (expected but none provided)
     *      - Signature cannot be verified
     *      - Token algorithm is not supported
     *      - Any claim-based test fails
     */
    public function verify(string $token, array $options = []) : array
    {
        $verifiedToken = parent::verify($token, $options);

        /*
         * Subject check
         */

        $tokenSub = $verifiedToken['sub'] ?? null;
        if (! $tokenSub || ! is_string($tokenSub)) {
            throw new InvalidTokenException('Subject (sub) claim must be a string present in the ID token');
        }

        /*
         * Clock checks
         */

        $now    = $options['time'] ?? time();
        $leeway = $options['leeway'] ?? $this->leeway;

        $tokenIat = $verifiedToken['iat'] ?? null;
        if (! $tokenIat || ! is_int($tokenIat)) {
            throw new InvalidTokenException('Issued At (iat) claim must be a number present in the ID token');
        }

        /*
         * Nonce check
         */

        if (! empty($options['nonce'])) {
            $tokenNonce = $verifiedToken['nonce'] ?? null;

            if (! $tokenNonce || ! is_string($tokenNonce)) {
                throw new InvalidTokenException('Nonce (nonce) claim must be a string present in the ID token');
            }

            if ($tokenNonce !== $options['nonce']) {
                throw new InvalidTokenException( sprintf(
                    'Nonce (nonce) claim mismatch in the ID token; expected "%s", found "%s"',
                    $options['nonce'],
                    $tokenNonce
                ) );
            }
        }

        /*
         * Authorized party check
         */
        $tokenAud = $verifiedToken['aud'] ?? null;

        if (is_array($tokenAud) && count($tokenAud) > 1) {
            $tokenAzp = $verifiedToken['azp'] ?? null;

            if (! $tokenAzp || ! is_string($tokenAzp)) {
                throw new InvalidTokenException(
                    'Authorized Party (azp) claim must be a string present in the ID token when Audience (aud) claim has multiple values'
                );
            }

            if ($tokenAzp !== $this->audience) {
                throw new InvalidTokenException( sprintf(
                    'Authorized Party (azp) claim mismatch in the ID token; expected "%s", found "%s"',
                    $this->audience,
                    $tokenAzp
                ) );
            }
        }

        /*
         * Authentication time check
         */

        if (! empty($options['max_age'])) {
            $tokenAuthTime = $verifiedToken['auth_time'] ?? null;

            if (! $tokenAuthTime || ! is_int($tokenAuthTime)) {
                throw new InvalidTokenException(
                    'Authentication Time (auth_time) claim must be a number present in the ID token when Max Age (max_age) is specified'
                );
            }

            $authValidUntil = $tokenAuthTime + $options['max_age'] + $leeway;

            if ($now > $authValidUntil) {
                throw new InvalidTokenException( sprintf(
                    'Authentication Time (auth_time) claim in the ID token indicates that too much time has passed since the last end-user authentication. Current time (%d) is after last auth at %d',
                    $now,
                    $authValidUntil
                ) );
            }
        }

        return $verifiedToken;
    }
}
