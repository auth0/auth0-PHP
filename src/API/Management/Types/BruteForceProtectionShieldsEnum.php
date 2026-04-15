<?php

namespace Auth0\SDK\API\Management\Types;

enum BruteForceProtectionShieldsEnum: string
{
    case Block = "block";
    case UserNotification = "user_notification";
}
