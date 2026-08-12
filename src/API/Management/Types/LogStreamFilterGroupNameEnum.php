<?php

namespace Auth0\SDK\API\Management\Types;

enum LogStreamFilterGroupNameEnum: string
{
    case AuthLoginFail = "auth.login.fail";
    case AuthLoginNotification = "auth.login.notification";
    case AuthLoginSuccess = "auth.login.success";
    case AuthLogoutFail = "auth.logout.fail";
    case AuthLogoutSuccess = "auth.logout.success";
    case AuthSignupFail = "auth.signup.fail";
    case AuthSignupSuccess = "auth.signup.success";
    case AuthSilentAuthFail = "auth.silent_auth.fail";
    case AuthSilentAuthSuccess = "auth.silent_auth.success";
    case AuthTokenExchangeFail = "auth.token_exchange.fail";
    case AuthTokenExchangeSuccess = "auth.token_exchange.success";
    case ManagementFail = "management.fail";
    case ManagementSuccess = "management.success";
    case ScimEvent = "scim.event";
    case SystemNotification = "system.notification";
    case UserFail = "user.fail";
    case UserNotification = "user.notification";
    case UserSuccess = "user.success";
    case Actions = "actions";
    case Other = "other";
}
