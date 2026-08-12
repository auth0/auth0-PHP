<?php

namespace Auth0\SDK\API\Management\Types;

enum LogStreamStatusEnum: string
{
    case Active = "active";
    case Paused = "paused";
    case Suspended = "suspended";
}
