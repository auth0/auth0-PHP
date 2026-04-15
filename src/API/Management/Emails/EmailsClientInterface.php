<?php

namespace Auth0\SDK\API\Management\Emails;

use Auth0\SDK\API\Management\Emails\Provider\ProviderClientInterface;

interface EmailsClientInterface
{
    /**
     * @return ProviderClientInterface
     */
    public function getProvider(): ProviderClientInterface;
}
