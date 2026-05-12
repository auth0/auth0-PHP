<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventUserUpdatedObjectIdentitiesItemEnterpriseProviderEnum: string
{
    case Ad = "ad";
    case Adfs = "adfs";
    case GoogleApps = "google-apps";
    case Ip = "ip";
    case Office365 = "office365";
    case Oidc = "oidc";
    case Okta = "okta";
    case Pingfederate = "pingfederate";
    case Samlp = "samlp";
    case Sharepoint = "sharepoint";
    case Waad = "waad";
}
