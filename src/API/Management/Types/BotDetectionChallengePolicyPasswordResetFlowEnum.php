<?php

namespace Auth0\SDK\API\Management\Types;

enum BotDetectionChallengePolicyPasswordResetFlowEnum: string
{
    case Never = "never";
    case WhenRisky = "when_risky";
    case Always = "always";
}
