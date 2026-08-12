<?php

namespace Auth0\SDK\API\Management\Types;

enum DeviceCredentialTypeEnum: string
{
    case PublicKey = "public_key";
    case RefreshToken = "refresh_token";
    case RotatingRefreshToken = "rotating_refresh_token";
}
