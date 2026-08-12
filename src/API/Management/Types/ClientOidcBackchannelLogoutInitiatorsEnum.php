<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientOidcBackchannelLogoutInitiatorsEnum: string
{
    case RpLogout = "rp-logout";
    case IdpLogout = "idp-logout";
    case PasswordChanged = "password-changed";
    case SessionExpired = "session-expired";
    case SessionRevoked = "session-revoked";
    case AccountDeleted = "account-deleted";
    case EmailIdentifierChanged = "email-identifier-changed";
    case MfaPhoneUnenrolled = "mfa-phone-unenrolled";
    case AccountDeactivated = "account-deactivated";
}
