<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientRedirectionPolicyEnum: string
{
    case AllowAlways = "allow_always";
    case OpenRedirectProtection = "open_redirect_protection";
}
