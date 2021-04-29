<?php

declare(strict_types=1);

namespace Auth0\SDK\Helpers\Tokens;

use Lcobucci\JWT\Signer\Hmac\Sha256 as HsSigner;
use Lcobucci\JWT\Token;

/**
 * Class SymmetricVerifier
 */
final class SymmetricVerifier extends SignatureVerifier
{
    /**
     * Client secret for the application.
     */
    private string $clientSecret;

    /**
     * SymmetricVerifier constructor.
     *
     * @param string $clientSecret Client secret for the application.
     */
    public function __construct(
        string $clientSecret
    ) {
        $this->clientSecret = $clientSecret;
        parent::__construct('HS256');
    }

    /**
     * Check the token signature.
     *
     * @param Token $token Parsed token to check.
     */
    protected function checkSignature(
        Token $token
    ): bool {
        return $token->verify(new HsSigner(), $this->clientSecret);
    }

    /**
     * Algorithm for signature check.
     */
    protected function getAlgorithm(): string
    {
        return 'HS256';
    }
}
