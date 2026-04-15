<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionProviderEnumSms: string
{
    case SmsGateway = "sms_gateway";
    case Twilio = "twilio";
}
