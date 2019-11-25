<?php
/**
 * Contains Trait WP_Auth0_AsymmetricVerifier.
 *
 * @package WP-Auth0
 *
 * @since 4.0.0
 */

use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsSigner;
use Lcobucci\JWT\Token;

/**
 * Class WP_Auth0_AsymmetricVerifier
 */
final class WP_Auth0_AsymmetricVerifier extends WP_Auth0_SignatureVerifier
{

    /**
     * JWKS array with kid as keys, PEM cert as values.
     *
     * @var array
     */
    private $jwks;

    /**
     * JwksVerifier constructor.
     *
     * @param array $jwks JWKS to use.
     */
    public function __construct(array $jwks)
    {
        $this->jwks = $jwks;
        parent::__construct('RS256');
    }

    /**
     * Check the token kid and signature.
     *
     * @param Token $token Parsed token to check.
     *
     * @return boolean
     *
     * @throws WP_Auth0_InvalidIdTokenException If ID token kid was not found in the JWKS.
     */
    protected function checkSignature(Token $token) : bool
    {
        $tokenKid = $token->getHeader('kid', false);
        if (! array_key_exists($tokenKid, $this->jwks)) {
            throw new WP_Auth0_InvalidIdTokenException('ID token key ID "'.$tokenKid.'" was not found in the JWKS');
        }

        return $token->verify(new RsSigner(), new Key($this->jwks[$tokenKid]));
    }
}
