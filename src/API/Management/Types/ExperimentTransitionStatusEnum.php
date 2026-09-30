<?php

namespace Auth0\SDK\API\Management\Types;

enum ExperimentTransitionStatusEnum: string
{
    case Active = "active";
    case Paused = "paused";
    case Completed = "completed";
    case Archived = "archived";
}
