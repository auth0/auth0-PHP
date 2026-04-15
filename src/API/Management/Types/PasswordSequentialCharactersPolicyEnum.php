<?php

namespace Auth0\SDK\API\Management\Types;

enum PasswordSequentialCharactersPolicyEnum: string
{
    case Allow = "allow";
    case Block = "block";
}
