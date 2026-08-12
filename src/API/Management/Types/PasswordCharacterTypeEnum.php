<?php

namespace Auth0\SDK\API\Management\Types;

enum PasswordCharacterTypeEnum: string
{
    case Uppercase = "uppercase";
    case Lowercase = "lowercase";
    case Number = "number";
    case Special = "special";
}
