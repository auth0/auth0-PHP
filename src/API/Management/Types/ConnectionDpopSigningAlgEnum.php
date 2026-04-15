<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionDpopSigningAlgEnum: string
{
    case Es256 = "ES256";
    case Ed25519 = "Ed25519";
}
