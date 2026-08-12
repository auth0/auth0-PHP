<?php

namespace Auth0\SDK\API\Management\Types;

enum GuardianFactorNameEnum: string
{
    case PushNotification = "push-notification";
    case Sms = "sms";
    case Email = "email";
    case Duo = "duo";
    case Otp = "otp";
    case WebauthnRoaming = "webauthn-roaming";
    case WebauthnPlatform = "webauthn-platform";
    case RecoveryCode = "recovery-code";
}
