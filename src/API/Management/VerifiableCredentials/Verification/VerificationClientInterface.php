<?php

namespace Auth0\SDK\API\Management\VerifiableCredentials\Verification;

use Auth0\SDK\API\Management\VerifiableCredentials\Verification\Templates\TemplatesClientInterface;

interface VerificationClientInterface
{
    /**
     * @return TemplatesClientInterface
     */
    public function getTemplates(): TemplatesClientInterface;
}
