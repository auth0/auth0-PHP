<?php

namespace Auth0\SDK\API\Management\Types;

enum BruteForceProtectionModeEnum: string
{
    case CountPerIdentifierAndIp = "count_per_identifier_and_ip";
    case CountPerIdentifier = "count_per_identifier";
}
