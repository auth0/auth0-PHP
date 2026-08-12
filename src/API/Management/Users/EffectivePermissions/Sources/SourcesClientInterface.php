<?php

namespace Auth0\SDK\API\Management\Users\EffectivePermissions\Sources;

use Auth0\SDK\API\Management\Users\EffectivePermissions\Sources\Roles\RolesClientInterface;

interface SourcesClientInterface
{
    /**
     * @return RolesClientInterface
     */
    public function getRoles(): RolesClientInterface;
}
