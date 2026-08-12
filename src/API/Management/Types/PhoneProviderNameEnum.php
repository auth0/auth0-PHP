<?php

namespace Auth0\SDK\API\Management\Types;

enum PhoneProviderNameEnum: string
{
    case Twilio = "twilio";
    case Custom = "custom";
}
