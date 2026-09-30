<?php

namespace Auth0\SDK\API\Management\Types;

enum AllocationStrategyEnum: string
{
    case Percentage = "percentage";
    case Segment = "segment";
}
