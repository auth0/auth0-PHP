<?php

namespace Auth0\SDK\API\Management\Types;

enum ResourceServerSubjectTypeAuthorizationClientPolicyEnum: string
{
    case DenyAll = "deny_all";
    case RequireClientGrant = "require_client_grant";
}
