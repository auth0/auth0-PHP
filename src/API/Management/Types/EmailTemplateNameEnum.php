<?php

namespace Auth0\SDK\API\Management\Types;

enum EmailTemplateNameEnum: string
{
    case VerifyEmail = "verify_email";
    case VerifyEmailByCode = "verify_email_by_code";
    case ResetEmail = "reset_email";
    case ResetEmailByCode = "reset_email_by_code";
    case WelcomeEmail = "welcome_email";
    case BlockedAccount = "blocked_account";
    case StolenCredentials = "stolen_credentials";
    case EnrollmentEmail = "enrollment_email";
    case MfaOobCode = "mfa_oob_code";
    case UserInvitation = "user_invitation";
    case ChangePassword = "change_password";
    case PasswordReset = "password_reset";
    case AsyncApproval = "async_approval";
}
