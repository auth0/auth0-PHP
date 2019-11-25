<?php
/**
 * Contains Trait WP_Auth0_SymmetricVerifier.
 *
 * @package WP-Auth0
 *
 * @since 4.0.0
 */

use Lcobucci\JWT\Signer\Hmac\Sha256 as HsSigner;
use Lcobucci\JWT\Token;

/**
 * Class WP_Auth0_SymmetricVerifier
 */
final class WP_Auth0_SymmetricVerifier extends WP_Auth0_SignatureVerifier
{

    /**
     * Client secret for the application.
     *
     * @var string
     */
    private $clientSecret;

    /**
     * SymmetricVerifier constructor.
     *
     * @param string $clientSecret Client secret for the application.
     */
    public function __construct(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
        parent::__construct('HS256');
    }

    /**
     * Check the token signature.
     *
     * @param Token $token Parsed token to check.
     *
     * @return boolean
     */
    protected function checkSignature(Token $token) : bool
    {
        return $token->verify(new HsSigner(), $this->clientSecret);
    }

    /**
     * Algorithm for signature check.
     *
     * @return string
     */
    protected function getAlgorithm() : string
    {
        return 'HS256';
    }
}
