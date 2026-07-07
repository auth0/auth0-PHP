<?php

namespace Auth0\SDK\API\Management\Types;

enum PhoneProviderProtectionBackoffStrategyEnum: string
{
    case Exponential = "exponential";
    case Default_ = "default";
}
