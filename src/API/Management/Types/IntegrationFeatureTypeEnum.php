<?php

namespace Auth0\SDK\API\Management\Types;

enum IntegrationFeatureTypeEnum: string
{
    case Unspecified = "unspecified";
    case Action = "action";
    case SocialConnection = "social_connection";
    case LogStream = "log_stream";
    case SsoIntegration = "sso_integration";
    case SmsProvider = "sms_provider";
}
