<?php

namespace Auth0\SDK\API\Management\Types;

enum BreachedPasswordDetectionAdminNotificationFrequencyEnum: string
{
    case Immediately = "immediately";
    case Daily = "daily";
    case Weekly = "weekly";
    case Monthly = "monthly";
}
