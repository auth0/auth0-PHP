<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers\Tokens;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256 as HsSigner;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Validation\Constraint\SignedWith;

/**
 * Class SymmetricVerifier
 *
 * @package Auth0\SDK\Helpers
 */
final class SymmetricVerifier extends SignatureVerifier
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
        $config = Configuration::forSymmetricSigner(new HsSigner(), InMemory::plainText($this->clientSecret));
        $config->setValidationConstraints(new SignedWith($config->signer(), $config->signingKey()));

        return $config->validator()->validate($token, ...$config->validationConstraints());
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
