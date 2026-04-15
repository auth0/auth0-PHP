<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientSessionTransferAllowedAuthenticationMethodsEnum: string
{
    case Cookie = "cookie";
    case Query = "query";
}
