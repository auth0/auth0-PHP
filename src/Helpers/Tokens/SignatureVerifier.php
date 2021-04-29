<?php

declare(strict_types=1);

namespace Auth0\SDK\Helpers\Tokens;

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
     */
    private string $alg;

    /**
     * Token parser.
     */
    private Parser $parser;

    /**
     * SignatureVerifier constructor.
     *
     * @param string $alg Token algorithm type.
     */
    public function __construct(
        string $alg
    ) {
        $this->alg = $alg;
        $this->parser = new Parser();
    }

    /**
     * Format, algorithm, and signature checks.
     *
     * @param string $token Raw JWT ID token.
     *
     * @throws InvalidTokenException If JWT format is incorrect.
     * @throws InvalidTokenException If token algorithm does not match the validator.
     * @throws InvalidTokenException If token algorithm signature cannot be validated.
     */
    final public function verifyAndDecode(
        string $token
    ): Token {
        try {
            $parsedToken = $this->parser->parse($token);
        } catch (\InvalidArgumentException | \RuntimeException $exception) {
            throw new \Auth0\SDK\Exception\InvalidTokenException('ID token could not be decoded');
        }

        $tokenAlg = $parsedToken->getHeader('alg', false);
        if ($tokenAlg !== $this->alg) {
            throw new \Auth0\SDK\Exception\InvalidTokenException(
                sprintf(
                    'Signature algorithm of "%s" is not supported. Expected the ID token to be signed with "%s".',
                    $tokenAlg,
                    $this->alg
                )
            );
        }

        if (! $this->checkSignature($parsedToken)) {
            throw new \Auth0\SDK\Exception\InvalidTokenException('Invalid ID token signature');
        }

        return $parsedToken;
    }

    /**
     * Check the token's signature.
     *
     * @param Token $parsedToken Parsed token to check.
     */
    abstract protected function checkSignature(
        Token $parsedToken
    ): bool;
}
