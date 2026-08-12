<?php

namespace Auth0\SDK\API\Management\Types;

enum BotDetectionChallengePolicyPasswordFlowEnum: string
{
    case Never = "never";
    case WhenRisky = "when_risky";
    case Always = "always";
}
