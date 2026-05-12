<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionTokenEndpointJwtcaAudFormatEnumOidc: string
{
    case Issuer = "issuer";
    case TokenEndpoint = "token_endpoint";
}
