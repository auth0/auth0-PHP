<?php

namespace Auth0\SDK\API\Management\Types;

enum RateLimitPolicyConfigurationOneAction: string
{
    case Block = "block";
    case Log = "log";
}
