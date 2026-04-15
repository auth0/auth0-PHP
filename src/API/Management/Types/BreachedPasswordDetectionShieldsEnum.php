<?php

namespace Auth0\SDK\API\Management\Types;

enum BreachedPasswordDetectionShieldsEnum: string
{
    case Block = "block";
    case UserNotification = "user_notification";
    case AdminNotification = "admin_notification";
}
