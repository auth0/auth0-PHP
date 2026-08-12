<?php

namespace Auth0\SDK\API\Management\Types;

enum ActionTriggerTypeEnum: string
{
    case PostLogin = "post-login";
    case CredentialsExchange = "credentials-exchange";
    case PreUserRegistration = "pre-user-registration";
    case PostUserRegistration = "post-user-registration";
    case PostChangePassword = "post-change-password";
    case SendPhoneMessage = "send-phone-message";
    case CustomPhoneProvider = "custom-phone-provider";
    case CustomEmailProvider = "custom-email-provider";
    case PasswordResetPostChallenge = "password-reset-post-challenge";
    case CustomTokenExchange = "custom-token-exchange";
    case EventStream = "event-stream";
    case PasswordHashMigration = "password-hash-migration";
    case LoginPostIdentifier = "login-post-identifier";
    case SignupPostIdentifier = "signup-post-identifier";
}
