<?php

namespace Auth0\SDK\API\Management\Types;

enum CspPolicyMode: string
{
    case Enforcing = "enforcing";
    case Reporting = "reporting";
}
