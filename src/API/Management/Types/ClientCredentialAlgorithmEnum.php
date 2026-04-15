<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientCredentialAlgorithmEnum: string
{
    case Rs256 = "RS256";
    case Rs384 = "RS384";
    case Ps256 = "PS256";
}
