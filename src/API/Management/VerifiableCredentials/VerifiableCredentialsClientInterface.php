<?php

namespace Auth0\SDK\API\Management\VerifiableCredentials;

use Auth0\SDK\API\Management\VerifiableCredentials\Verification\VerificationClientInterface;

interface VerifiableCredentialsClientInterface
{
    /**
     * @return VerificationClientInterface
     */
    public function getVerification(): VerificationClientInterface;
}
