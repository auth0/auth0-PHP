<?php

namespace Auth0\SDK\API\Management\Types;

enum GuardianFactorsProviderPushNotificationProviderDataEnum: string
{
    case Guardian = "guardian";
    case Sns = "sns";
    case Direct = "direct";
}
