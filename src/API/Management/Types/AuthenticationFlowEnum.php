<?php

namespace Auth0\SDK\API\Management\Types;

enum AuthenticationFlowEnum: string
{
    case Authentication = "authentication";
    case MfaEnrollment = "mfa_enrollment";
    case MfaChallenge = "mfa_challenge";
    case PasswordReset = "password_reset";
    case PasskeyEnrollment = "passkey_enrollment";
    case All = "all";
}
