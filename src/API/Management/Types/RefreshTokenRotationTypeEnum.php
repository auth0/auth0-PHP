<?php

namespace Auth0\SDK\API\Management\Types;

enum RefreshTokenRotationTypeEnum: string
{
    case Rotating = "rotating";
    case NonRotating = "non-rotating";
}
