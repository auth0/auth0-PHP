<?php

namespace Auth0\SDK\API\Management\Types;

enum PostConnectionKeysAlgEnum: string
{
    case Rs256 = "RS256";
    case Rs384 = "RS384";
    case Rs512 = "RS512";
    case Ps256 = "PS256";
    case Ps384 = "PS384";
    case Es256 = "ES256";
    case Es384 = "ES384";
}
