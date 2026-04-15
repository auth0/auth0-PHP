<?php

namespace Auth0\SDK\API\Management\Types;

enum PromptGroupNameEnum: string
{
    case Login = "login";
    case LoginId = "login-id";
    case LoginPassword = "login-password";
    case LoginPasswordless = "login-passwordless";
    case LoginEmailVerification = "login-email-verification";
    case Signup = "signup";
    case SignupId = "signup-id";
    case SignupPassword = "signup-password";
    case PhoneIdentifierEnrollment = "phone-identifier-enrollment";
    case PhoneIdentifierChallenge = "phone-identifier-challenge";
    case EmailIdentifierChallenge = "email-identifier-challenge";
    case ResetPassword = "reset-password";
    case CustomForm = "custom-form";
    case Consent = "consent";
    case CustomizedConsent = "customized-consent";
    case Logout = "logout";
    case MfaPush = "mfa-push";
    case MfaOtp = "mfa-otp";
    case MfaVoice = "mfa-voice";
    case MfaPhone = "mfa-phone";
    case MfaWebauthn = "mfa-webauthn";
    case MfaSms = "mfa-sms";
    case MfaEmail = "mfa-email";
    case MfaRecoveryCode = "mfa-recovery-code";
    case Mfa = "mfa";
    case Status = "status";
    case DeviceFlow = "device-flow";
    case EmailVerification = "email-verification";
    case EmailOtpChallenge = "email-otp-challenge";
    case Organizations = "organizations";
    case Invitation = "invitation";
    case Common = "common";
    case Passkeys = "passkeys";
    case Captcha = "captcha";
    case BruteForceProtection = "brute-force-protection";
    case AsyncApprovalFlow = "async-approval-flow";
}
