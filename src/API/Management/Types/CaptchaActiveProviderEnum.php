<?php

namespace Auth0\SDK\API\Management\Types;

enum CaptchaActiveProviderEnum: string
{
    case SimpleCaptcha = "simple_captcha";
    case AuthChallenge = "auth_challenge";
    case RecaptchaV2 = "recaptcha_v2";
    case RecaptchaEnterprise = "recaptcha_enterprise";
    case Hcaptcha = "hcaptcha";
    case FriendlyCaptcha = "friendly_captcha";
    case Arkose = "arkose";
}
