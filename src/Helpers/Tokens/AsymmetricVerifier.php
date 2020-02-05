<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\JWKFetcher;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsSigner;
use Lcobucci\JWT\Token;

/**
 * Class AsymmetricVerifier
 *
 * @package Auth0\SDK\Helpers
 */
final class AsymmetricVerifier extends SignatureVerifier
{

    /**
     * Array of kid => keys or a JWKFetcher instance.
     *
     * @var array|JWKFetcher
     */
    private $jwks;

    /**
     * JwksVerifier constructor.
     *
     * @param array|JWKFetcher $jwks Array of kid => keys or a JWKFetcher instance.
     */
    public function __construct($jwks)
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
     * @throws InvalidTokenException If ID token kid was not found in the JWKS.
     */
    protected function checkSignature(Token $token) : bool
    {
        $tokenKid   = $token->getHeader('kid', false);
        $signingKey = is_array( $this->jwks ) ? ($this->jwks[$tokenKid] ?? null) : $this->jwks->getKey( $tokenKid );
        if (! $signingKey) {
            throw new InvalidTokenException( 'ID token key ID "'.$tokenKid.'" was not found in the JWKS' );
        }

        return $token->verify(new RsSigner(), new Key($signingKey));
    }
}
