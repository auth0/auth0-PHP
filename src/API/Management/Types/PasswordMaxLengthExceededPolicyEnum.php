<?php

namespace Auth0\SDK\API\Management\Types;

enum PasswordMaxLengthExceededPolicyEnum: string
{
    case Truncate = "truncate";
    case Error = "error";
}
