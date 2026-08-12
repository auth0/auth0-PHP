<?php

namespace Auth0\SDK\API\Management\Types;

enum ActionExecutionStatusEnum: string
{
    case Unspecified = "unspecified";
    case Pending = "pending";
    case Final_ = "final";
    case Partial = "partial";
    case Canceled = "canceled";
    case Suspended = "suspended";
}
