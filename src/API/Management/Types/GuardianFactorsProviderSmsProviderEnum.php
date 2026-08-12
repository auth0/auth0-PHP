<?php

namespace Auth0\SDK\API\Management\Types;

enum GuardianFactorsProviderSmsProviderEnum: string
{
    case Auth0 = "auth0";
    case Twilio = "twilio";
    case PhoneMessageHook = "phone-message-hook";
}
