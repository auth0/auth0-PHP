<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionKeyUseEnum: string
{
    case Encryption = "encryption";
    case Signing = "signing";
}
