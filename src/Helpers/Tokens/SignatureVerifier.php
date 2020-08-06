<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;
use InvalidArgumentException;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Token;

/**
 * Class SignatureVerifier
 *
 * @package Auth0\SDK\Helpers
 */
abstract class SignatureVerifier
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
     * @throws InvalidTokenException If JWT format is incorrect.
     * @throws InvalidTokenException If token algorithm does not match the validator.
     * @throws InvalidTokenException If token algorithm signature cannot be validated.
     */
    final public function verifyAndDecode(string $token) : Token
    {
        try {
            $parsedToken = $this->parser->parse($token);
        } catch (InvalidArgumentException | \RuntimeException $e) {
            throw new InvalidTokenException( 'ID token could not be decoded' );
        }

        $tokenAlg = $parsedToken->getHeader('alg', false);
        if ($tokenAlg !== $this->alg) {
            throw new InvalidTokenException( sprintf(
                'Signature algorithm of "%s" is not supported. Expected the ID token to be signed with "%s".',
                $tokenAlg,
                $this->alg
            ) );
        }

        if (! $this->checkSignature($parsedToken)) {
            throw new InvalidTokenException('Invalid ID token signature');
        }

        return $parsedToken;
    }
}
