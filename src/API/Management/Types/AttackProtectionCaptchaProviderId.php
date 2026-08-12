<?php

namespace Auth0\SDK\API\Management\Types;

enum AttackProtectionCaptchaProviderId: string
{
    case Arkose = "arkose";
    case AuthChallenge = "auth_challenge";
    case FriendlyCaptcha = "friendly_captcha";
    case Hcaptcha = "hcaptcha";
    case RecaptchaV2 = "recaptcha_v2";
    case RecaptchaEnterprise = "recaptcha_enterprise";
    case SimpleCaptcha = "simple_captcha";
}
