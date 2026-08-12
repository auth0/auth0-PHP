<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionApiBehaviorEnum: string
{
    case Required = "required";
    case Optional = "optional";
}
