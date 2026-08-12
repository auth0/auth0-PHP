<?php

namespace Auth0\SDK\API\Management\Types;

enum CustomDomainCustomClientIpHeaderEnum: string
{
    case TrueClientIp = "true-client-ip";
    case CfConnectingIp = "cf-connecting-ip";
    case XForwardedFor = "x-forwarded-for";
    case XAzureClientip = "x-azure-clientip";
    case Empty = "";
}
