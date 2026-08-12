<?php

namespace Auth0\SDK\API\Management\Types;

enum DomainCertificateStatusEnum: string
{
    case Provisioning = "provisioning";
    case ProvisioningFailed = "provisioning_failed";
    case Provisioned = "provisioned";
    case RenewingFailed = "renewing_failed";
}
