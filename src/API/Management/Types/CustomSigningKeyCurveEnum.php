<?php

namespace Auth0\SDK\API\Management\Types;

enum CustomSigningKeyCurveEnum: string
{
    case P256 = "P-256";
    case P384 = "P-384";
    case P521 = "P-521";
}
