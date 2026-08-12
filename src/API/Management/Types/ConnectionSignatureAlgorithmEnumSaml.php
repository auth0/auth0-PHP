<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionSignatureAlgorithmEnumSaml: string
{
    case RsaSha1 = "rsa-sha1";
    case RsaSha256 = "rsa-sha256";
}
