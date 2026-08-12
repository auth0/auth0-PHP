<?php

namespace Auth0\SDK\API\Management\Types;

enum CreatedUserAuthenticationMethodTypeEnum: string
{
    case Phone = "phone";
    case Email = "email";
    case Totp = "totp";
    case WebauthnRoaming = "webauthn-roaming";
    case Passkey = "passkey";
}
