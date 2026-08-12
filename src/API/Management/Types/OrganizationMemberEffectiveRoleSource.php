<?php

namespace Auth0\SDK\API\Management\Types;

enum OrganizationMemberEffectiveRoleSource: string
{
    case Direct = "direct";
    case Groups = "groups";
}
