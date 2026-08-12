<?php

namespace Auth0\SDK\API\Management\Types;

enum UserEffectivePermissionSourceEnum: string
{
    case Direct = "direct";
    case Roles = "roles";
}
