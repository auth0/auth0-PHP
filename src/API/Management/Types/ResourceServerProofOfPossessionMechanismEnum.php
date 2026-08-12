<?php

namespace Auth0\SDK\API\Management\Types;

enum ResourceServerProofOfPossessionMechanismEnum: string
{
    case Mtls = "mtls";
    case Dpop = "dpop";
}
