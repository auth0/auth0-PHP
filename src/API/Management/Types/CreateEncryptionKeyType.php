<?php

namespace Auth0\SDK\API\Management\Types;

enum CreateEncryptionKeyType: string
{
    case CustomerProvidedRootKey = "customer-provided-root-key";
    case TenantEncryptionKey = "tenant-encryption-key";
}
