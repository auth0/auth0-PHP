<?php

namespace Auth0\SDK\API\Management\Types;

enum PasswordIdenticalCharactersPolicyEnum: string
{
    case Allow = "allow";
    case Block = "block";
}
