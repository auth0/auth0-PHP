<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionIdentityApiEnumAzureAd: string
{
    case MicrosoftIdentityPlatformV20 = "microsoft-identity-platform-v2.0";
    case AzureActiveDirectoryV10 = "azure-active-directory-v1.0";
}
