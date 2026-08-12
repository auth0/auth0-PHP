<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionWaadProtocolEnumAzureAd: string
{
    case WsFederation = "ws-federation";
    case OpenidConnect = "openid-connect";
}
