<?php

namespace Auth0\SDK\API\Management\Types;

enum ResourceServerSubjectTypeAuthorizationUserPolicyEnum: string
{
    case AllowAll = "allow_all";
    case DenyAll = "deny_all";
    case RequireClientGrant = "require_client_grant";
}
