<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionDpopSigningAlgEnum: string
{
    case Es256 = "ES256";
    case Es384 = "ES384";
    case Es512 = "ES512";
    case Ed25519 = "Ed25519";
}
