<?php

namespace Auth0\SDK\API\Management\Types;

enum TenantSettingsDynamicClientRegistrationSecurityMode: string
{
    case Strict = "strict";
    case Permissive = "permissive";
}
