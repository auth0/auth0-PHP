<?php

namespace Auth0\SDK\API\Management\Types;

enum SelfServiceProfileSsoTicketIdpInitiatedClientProtocolEnum: string
{
    case Samlp = "samlp";
    case Wsfed = "wsfed";
    case Oauth2 = "oauth2";
}
