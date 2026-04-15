<?php

namespace Auth0\SDK\API\Management\Types;

enum BreachedPasswordDetectionMethodEnum: string
{
    case Standard = "standard";
    case Enhanced = "enhanced";
}
