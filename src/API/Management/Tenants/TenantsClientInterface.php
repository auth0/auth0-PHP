<?php

namespace Auth0\SDK\API\Management\Tenants;

use Auth0\SDK\API\Management\Tenants\Settings\SettingsClientInterface;

interface TenantsClientInterface
{
    /**
     * @return SettingsClientInterface
     */
    public function getSettings(): SettingsClientInterface;
}
