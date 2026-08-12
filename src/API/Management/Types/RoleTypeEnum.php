<?php

namespace Auth0\SDK\API\Management\Types;

enum RoleTypeEnum: string
{
    case Tenant = "tenant";
    case Organization = "organization";
}
