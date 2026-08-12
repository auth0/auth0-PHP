<?php

namespace Auth0\SDK\API\Management\Users\EffectiveRoles\Sources;

use Auth0\SDK\API\Management\Users\EffectiveRoles\Sources\Groups\GroupsClientInterface;

interface SourcesClientInterface
{
    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface;
}
