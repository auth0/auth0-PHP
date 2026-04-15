<?php

namespace Auth0\SDK\API\Management\Types;

enum EnabledFeaturesEnum: string
{
    case Scim = "scim";
    case UniversalLogout = "universal_logout";
}
