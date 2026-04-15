<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientSessionTransferDeviceBindingEnum: string
{
    case Ip = "ip";
    case Asn = "asn";
    case None = "none";
}
