<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventConnectionUpdatedObject2OptionsIdpinitiatedClientProtocolEnum: string
{
    case Oidc = "oidc";
    case Samlp = "samlp";
    case Wsfed = "wsfed";
}
