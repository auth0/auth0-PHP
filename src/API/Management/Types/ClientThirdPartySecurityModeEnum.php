<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientThirdPartySecurityModeEnum: string
{
    case Strict = "strict";
    case Permissive = "permissive";
}
