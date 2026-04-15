<?php

namespace Auth0\SDK\API\Management\Types;

enum UserEnrollmentAuthMethodEnum: string
{
    case Authenticator = "authenticator";
    case Guardian = "guardian";
    case Sms = "sms";
    case WebauthnPlatform = "webauthn-platform";
    case WebauthnRoaming = "webauthn-roaming";
}
