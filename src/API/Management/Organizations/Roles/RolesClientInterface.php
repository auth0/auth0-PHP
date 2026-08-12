<?php

namespace Auth0\SDK\API\Management\Organizations\Roles;

use Auth0\SDK\API\Management\Organizations\Roles\Members\MembersClientInterface;
use Auth0\SDK\API\Management\Organizations\Roles\Groups\GroupsClientInterface;

interface RolesClientInterface
{
    /**
     * @return MembersClientInterface
     */
    public function getMembers(): MembersClientInterface;

    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface;
}
