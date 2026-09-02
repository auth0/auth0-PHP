<?php

namespace Auth0\SDK\API\Management\Types;

enum B2BIntegrationConfigurationIntegrationTypeEnum: string
{
    case CustomAuthServer = "custom_auth_server";
    case ThirdParty = "third_party";
    case Application = "application";
}
