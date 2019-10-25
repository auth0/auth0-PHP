<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;
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
     * @throws InvalidTokenException If ID token kid was not found in the JWKS.
     */
    protected function checkSignature(Token $token) : bool
    {
        $tokenKid = $token->getHeader('kid', false);
        if (! array_key_exists($tokenKid, $this->jwks)) {
            throw new InvalidTokenException( 'ID token key ID "'.$tokenKid.'" was not found in the JWKS' );
        }

        return $token->verify(new RsSigner(), new Key($this->jwks[$tokenKid]));
    }
}
