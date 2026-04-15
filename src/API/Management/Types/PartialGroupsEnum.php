<?php

namespace Auth0\SDK\API\Management\Types;

enum PartialGroupsEnum: string
{
    case Login = "login";
    case LoginId = "login-id";
    case LoginPassword = "login-password";
    case LoginPasswordless = "login-passwordless";
    case Signup = "signup";
    case SignupId = "signup-id";
    case SignupPassword = "signup-password";
    case CustomizedConsent = "customized-consent";
    case Passkeys = "passkeys";
}
