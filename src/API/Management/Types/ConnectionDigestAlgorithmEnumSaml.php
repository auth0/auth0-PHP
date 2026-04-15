<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionDigestAlgorithmEnumSaml: string
{
    case Sha1 = "sha1";
    case Sha256 = "sha256";
}
