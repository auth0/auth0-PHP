<?php

namespace Auth0\SDK\API\Management\Types;

enum UserEffectiveRoleSource: string
{
    case Direct = "direct";
    case Groups = "groups";
}
