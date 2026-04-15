<?php

namespace Auth0\SDK\API\Management\Types;

enum GuardianFactorPhoneFactorMessageTypeEnum: string
{
    case Sms = "sms";
    case Voice = "voice";
}
