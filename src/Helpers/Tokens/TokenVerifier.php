<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;

/**
 * Class TokenVerifier, a generic JWT verifier.
 * For verifying OIDC-compliant ID tokens, use Auth0\SDK\Helpers\Tokens\IdTokenVerifier
 *
 * @package Auth0\SDK\Helpers\Tokens
 */
class TokenVerifier
{

    /**
     * Token issuer base URL expected.
     *
     * @var string
     */
    protected $issuer;

    /**
     * Token audience expected.
     *
     * @var string
     */
    protected $audience;

    /**
     * Token signature verifier.
     *
     * @var SignatureVerifier
     */
    private $verifier;

    /**
     * Clock tolerance for time-base token checks in seconds.
     *
     * @var integer
     */
    protected $leeway = 60;

    /**
     * TokenVerifier constructor.
     *
     * @param string            $issuer   Token issuer base URL expected.
     * @param string            $audience Token audience expected.
     * @param SignatureVerifier $verifier Token signature verifier.
     */
    public function __construct(string $issuer, string $audience, SignatureVerifier $verifier)
    {
        $this->issuer   = $issuer;
        $this->audience = $audience;
        $this->verifier = $verifier;
    }

    /**
     * Set a new leeway time for all token checks.
     *
     * @param integer $newLeeway New leeway time for class instance.
     *
     * @return void
     */
    public function setLeeway(int $newLeeway) : void
    {
        $this->leeway = $newLeeway;
    }

    /**
     * Verifies and decodes a JWT.
     *
     * @param string $token   Raw JWT string.
     * @param array  $options Options to adjust the verification. Can be:
     *      - "leeway" clock tolerance in seconds for the current check only. See $leeway above for default.
     *
     * @return array
     *
     * @throws InvalidTokenException Thrown if:
     *      - Token is missing (expected but none provided)
     *      - Signature cannot be verified
     *      - Token algorithm is not supported
     *      - Any claim-based test fails
     */
    public function verify(string $token, array $options = []) : array
    {
        if (empty($token)) {
            throw new InvalidTokenException('ID token is required but missing');
        }

        $verifiedToken = $this->verifier->verifyAndDecode( $token );

        /*
         * Issuer checks
         */

        $tokenIss = $verifiedToken->getClaim('iss', false);
        if (! $tokenIss || ! is_string($tokenIss)) {
            throw new InvalidTokenException('Issuer (iss) claim must be a string present in the ID token');
        }

        if ($tokenIss !== $this->issuer) {
            throw new InvalidTokenException( sprintf(
                'Issuer (iss) claim mismatch in the ID token; expected "%s", found "%s"', $this->issuer, $tokenIss
            ) );
        }

        /*
         * Audience checks
         */

        $tokenAud = $verifiedToken->getClaim('aud', false);
        if (! $tokenAud || (! is_string($tokenAud) && ! is_array($tokenAud))) {
            throw new InvalidTokenException(
                'Audience (aud) claim must be a string or array of strings present in the ID token'
            );
        }

        if (is_array($tokenAud) && ! in_array($this->audience, $tokenAud)) {
            throw new InvalidTokenException( sprintf(
                'Audience (aud) claim mismatch in the ID token; expected "%s" was not one of "%s"',
                $this->audience,
                implode(', ', $tokenAud)
            ) );
        } else if (is_string($tokenAud) && $tokenAud !== $this->audience) {
            throw new InvalidTokenException( sprintf(
                'Audience (aud) claim mismatch in the ID token; expected "%s", found "%s"', $this->audience, $tokenAud
            ) );
        }

        /*
         * Clock checks
         */

        $now    = $options['time'] ?? time();
        $leeway = $options['leeway'] ?? $this->leeway;

        $tokenExp = $verifiedToken->getClaim('exp', false);
        if (! $tokenExp || ! is_int($tokenExp)) {
            throw new InvalidTokenException('Expiration Time (exp) claim must be a number present in the ID token');
        }

        $expireTime = $tokenExp + $leeway;
        if ($now > $expireTime) {
            throw new InvalidTokenException( sprintf(
                'Expiration Time (exp) claim error in the ID token; current time (%d) is after expiration time (%d)',
                $now,
                $expireTime
            ) );
        }

        $profile = [];
        foreach ($verifiedToken->getClaims() as $claim => $value) {
            $profile[$claim] = $value->getValue();
        }

        return $profile;
    }
}
