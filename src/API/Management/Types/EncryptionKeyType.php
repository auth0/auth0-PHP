<?php

namespace Auth0\SDK\API\Management\Types;

enum EncryptionKeyType: string
{
    case CustomerProvidedRootKey = "customer-provided-root-key";
    case EnvironmentRootKey = "environment-root-key";
    case TenantMasterKey = "tenant-master-key";
    case TenantEncryptionKey = "tenant-encryption-key";
}
