<?php

namespace Auth0\SDK\API\Management\Types;

enum BreachedPasswordDetectionPreChangePasswordShieldsEnum: string
{
    case Block = "block";
    case AdminNotification = "admin_notification";
}
