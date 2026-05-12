<?php

namespace Auth0\SDK\API\Management\Types;

enum CredentialDeviceTypeEnum: string
{
    case SingleDevice = "single_device";
    case MultiDevice = "multi_device";
}
