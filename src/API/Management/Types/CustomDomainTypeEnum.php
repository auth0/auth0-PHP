<?php

namespace Auth0\SDK\API\Management\Types;

enum CustomDomainTypeEnum: string
{
    case Auth0ManagedCerts = "auth0_managed_certs";
    case SelfManagedCerts = "self_managed_certs";
}
