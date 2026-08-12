<?php

namespace Auth0\SDK\API\Management\Types;

enum TenantSettingsCountryCodesMode: string
{
    case Allow = "allow";
    case Deny = "deny";
}
