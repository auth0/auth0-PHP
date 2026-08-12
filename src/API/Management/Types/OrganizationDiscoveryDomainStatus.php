<?php

namespace Auth0\SDK\API\Management\Types;

enum OrganizationDiscoveryDomainStatus: string
{
    case Pending = "pending";
    case Verified = "verified";
}
