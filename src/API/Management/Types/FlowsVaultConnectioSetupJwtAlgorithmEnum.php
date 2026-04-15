<?php

namespace Auth0\SDK\API\Management\Types;

enum FlowsVaultConnectioSetupJwtAlgorithmEnum: string
{
    case Hs256 = "HS256";
    case Hs384 = "HS384";
    case Hs512 = "HS512";
    case Rs256 = "RS256";
    case Rs384 = "RS384";
    case Rs512 = "RS512";
    case Es256 = "ES256";
    case Es384 = "ES384";
    case Es512 = "ES512";
    case Ps256 = "PS256";
    case Ps384 = "PS384";
    case Ps512 = "PS512";
}
