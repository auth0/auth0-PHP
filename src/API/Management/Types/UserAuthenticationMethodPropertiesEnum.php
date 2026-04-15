<?php

namespace Auth0\SDK\API\Management\Types;

enum UserAuthenticationMethodPropertiesEnum: string
{
    case Totp = "totp";
    case Push = "push";
    case Sms = "sms";
    case Voice = "voice";
}
