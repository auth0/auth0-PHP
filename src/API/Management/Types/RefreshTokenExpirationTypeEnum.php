<?php

namespace Auth0\SDK\API\Management\Types;

enum RefreshTokenExpirationTypeEnum: string
{
    case Expiring = "expiring";
    case NonExpiring = "non-expiring";
}
