<?php

namespace Auth0\SDK\API\Management\Types;

enum CustomSigningKeyTypeEnum: string
{
    case Ec = "EC";
    case Rsa = "RSA";
}
