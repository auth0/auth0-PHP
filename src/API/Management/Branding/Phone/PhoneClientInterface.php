<?php

namespace Auth0\SDK\API\Management\Branding\Phone;

use Auth0\SDK\API\Management\Branding\Phone\Providers\ProvidersClientInterface;
use Auth0\SDK\API\Management\Branding\Phone\Templates\TemplatesClientInterface;

interface PhoneClientInterface
{
    /**
     * @return ProvidersClientInterface
     */
    public function getProviders(): ProvidersClientInterface;

    /**
     * @return TemplatesClientInterface
     */
    public function getTemplates(): TemplatesClientInterface;
}
