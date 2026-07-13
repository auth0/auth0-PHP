<?php

namespace Auth0\SDK\API\Management\Organizations\Roles;

use Auth0\SDK\API\Management\Organizations\Roles\Members\MembersClientInterface;

interface RolesClientInterface
{
    /**
     * @return MembersClientInterface
     */
    public function getMembers(): MembersClientInterface;
}
