<?php

namespace Auth0\SDK\API\Management\Types;

enum UserEffectivePermissionRoleSourceEnum: string
{
    case Direct = "direct";
    case Groups = "groups";
}
