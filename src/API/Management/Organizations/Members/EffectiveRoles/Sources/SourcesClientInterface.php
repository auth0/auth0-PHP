<?php

namespace Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\Sources;

use Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\Sources\Groups\GroupsClientInterface;

interface SourcesClientInterface
{
    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface;
}
