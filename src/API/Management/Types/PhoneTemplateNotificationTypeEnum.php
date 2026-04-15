<?php

namespace Auth0\SDK\API\Management\Types;

enum PhoneTemplateNotificationTypeEnum: string
{
    case OtpVerify = "otp_verify";
    case OtpEnroll = "otp_enroll";
    case ChangePassword = "change_password";
    case BlockedAccount = "blocked_account";
    case PasswordBreach = "password_breach";
}
