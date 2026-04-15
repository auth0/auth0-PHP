<?php

namespace Auth0\SDK\API\Management\Types;

enum AsyncApprovalNotificationsChannelsEnum: string
{
    case GuardianPush = "guardian-push";
    case Email = "email";
}
