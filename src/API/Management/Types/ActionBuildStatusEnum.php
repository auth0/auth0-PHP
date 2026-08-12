<?php

namespace Auth0\SDK\API\Management\Types;

enum ActionBuildStatusEnum: string
{
    case Pending = "pending";
    case Building = "building";
    case Packaged = "packaged";
    case Built = "built";
    case Retrying = "retrying";
    case Failed = "failed";
}
