<?php

namespace Auth0\SDK\API\Management\Types;

enum CspFlag: string
{
    case UpgradeInsecureRequests = "upgrade-insecure-requests";
    case BlockAllMixedContent = "block-all-mixed-content";
}
