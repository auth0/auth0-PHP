<?php

namespace Auth0\SDK\API\Management\Types;

enum GuardianEnrollmentFactorEnum: string
{
    case PushNotification = "push-notification";
    case Phone = "phone";
    case Email = "email";
    case Otp = "otp";
    case WebauthnRoaming = "webauthn-roaming";
    case WebauthnPlatform = "webauthn-platform";
}
