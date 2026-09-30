<?php

namespace Auth0\SDK\API\Management\Types;

enum ExperimentStatusEnum: string
{
    case Draft = "draft";
    case Active = "active";
    case Paused = "paused";
    case Completed = "completed";
    case Archived = "archived";
}
