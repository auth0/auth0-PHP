<?php

namespace Auth0\SDK\API\Management\Types;

enum SignupStatusEnum: string
{
    case Required = "required";
    case Optional = "optional";
    case Inactive = "inactive";
}
