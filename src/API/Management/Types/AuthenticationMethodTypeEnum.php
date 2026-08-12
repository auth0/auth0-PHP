<?php

namespace Auth0\SDK\API\Management\Types;

enum AuthenticationMethodTypeEnum: string
{
    case RecoveryCode = "recovery-code";
    case Totp = "totp";
    case Push = "push";
    case Phone = "phone";
    case Email = "email";
    case EmailVerification = "email-verification";
    case WebauthnRoaming = "webauthn-roaming";
    case WebauthnPlatform = "webauthn-platform";
    case Guardian = "guardian";
    case Passkey = "passkey";
    case Password = "password";
}
