<?php

namespace Auth0\SDK\API\Management\Types;

enum SigningAlgorithmEnum: string
{
    case Hs256 = "HS256";
    case Rs256 = "RS256";
    case Rs512 = "RS512";
    case Ps256 = "PS256";
}
