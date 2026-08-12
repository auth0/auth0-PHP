<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientGrantOrganizationNullableUsageEnum: string
{
    case Deny = "deny";
    case Allow = "allow";
    case Require_ = "require";
}
