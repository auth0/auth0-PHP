<?php

namespace Auth0\SDK\API\Management\Types;

enum UserAttributeProfileUserIdOidcStrategyOverrideMapping: string
{
    case Sub = "sub";
    case Oid = "oid";
    case Email = "email";
}
