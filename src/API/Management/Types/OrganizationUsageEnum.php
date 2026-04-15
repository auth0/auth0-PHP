<?php

namespace Auth0\SDK\API\Management\Types;

enum OrganizationUsageEnum: string
{
    case Deny = "deny";
    case Allow = "allow";
    case Require_ = "require";
}
