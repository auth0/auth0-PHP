<?php

namespace Auth0\SDK\API\Management\Types;

enum HookTriggerIdEnum: string
{
    case CredentialsExchange = "credentials-exchange";
    case PreUserRegistration = "pre-user-registration";
    case PostUserRegistration = "post-user-registration";
    case PostChangePassword = "post-change-password";
    case SendPhoneMessage = "send-phone-message";
}
