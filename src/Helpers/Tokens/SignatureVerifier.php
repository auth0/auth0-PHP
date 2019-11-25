<?php
/**
 * Contains Trait WP_Auth0_SignatureVerifier.
 *
 * @package WP-Auth0
 *
 * @since 4.0.0
 */

use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Token;

/**
 * Class WP_Auth0_SignatureVerifier
 */
abstract class WP_Auth0_SignatureVerifier
{

    /**
     * Token algorithm value.
     *
     * @var string
     */
    private $alg;

    /**
     * Token parser.
     *
     * @var Token
     */
    private $parser;

    /**
     * Check the token's signature.
     *
     * @param Token $parsedToken Parsed token to check.
     *
     * @return boolean
     */
    abstract protected function checkSignature(Token $parsedToken) : bool;

    /**
     * SignatureVerifier constructor.
     *
     * @param string $alg
     */
    public function __construct(string $alg)
    {
        $this->alg    = $alg;
        $this->parser = new Parser();
    }

    /**
     * Format, algorithm, and signature checks.
     *
     * @param string $token Raw JWT ID token.
     *
     * @return Token
     *
     * @throws WP_Auth0_InvalidIdTokenException If JWT format is incorrect.
     * @throws WP_Auth0_InvalidIdTokenException If token algorithm does not match the validator.
     * @throws WP_Auth0_InvalidIdTokenException If token algorithm signature cannot be validated.
     */
    final public function verifyAndDecode(string $token) : Token
    {
        try {
            $parsedToken = $this->parser->parse($token);
        } catch (InvalidArgumentException $e) {
            throw new WP_Auth0_InvalidIdTokenException('ID token could not be decoded');
        }

        $tokenAlg = $parsedToken->getHeader('alg', false);
        if ($tokenAlg !== $this->alg) {
            throw new WP_Auth0_InvalidIdTokenException( sprintf(
                'Signature algorithm of "%s" is not supported. Expected the ID token to be signed with "%s".',
                $tokenAlg,
                $this->alg
            ) );
        }

        if (! $this->checkSignature($parsedToken)) {
            throw new WP_Auth0_InvalidIdTokenException('Invalid ID token signature');
        }

        return $parsedToken;
    }
}
