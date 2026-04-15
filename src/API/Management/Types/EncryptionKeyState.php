<?php

namespace Auth0\SDK\API\Management\Types;

enum EncryptionKeyState: string
{
    case PreActivation = "pre-activation";
    case Active = "active";
    case Deactivated = "deactivated";
    case Destroyed = "destroyed";
}
