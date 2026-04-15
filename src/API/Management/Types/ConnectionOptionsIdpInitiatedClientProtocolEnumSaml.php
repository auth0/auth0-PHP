<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionOptionsIdpInitiatedClientProtocolEnumSaml: string
{
    case Oidc = "oidc";
    case Samlp = "samlp";
    case Wsfed = "wsfed";
}
