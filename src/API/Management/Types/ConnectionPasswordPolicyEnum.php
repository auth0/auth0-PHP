<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionPasswordPolicyEnum: string
{
    case None = "none";
    case Low = "low";
    case Fair = "fair";
    case Good = "good";
    case Excellent = "excellent";
}
