<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientAnonymousSessionTransferNetworkBindingEnum: string
{
    case Ip = "ip";
    case Asn = "asn";
    case None = "none";
}
