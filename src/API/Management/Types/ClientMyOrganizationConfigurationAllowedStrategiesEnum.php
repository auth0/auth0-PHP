<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientMyOrganizationConfigurationAllowedStrategiesEnum: string
{
    case Pingfederate = "pingfederate";
    case Adfs = "adfs";
    case Waad = "waad";
    case GoogleApps = "google-apps";
    case Okta = "okta";
    case Oidc = "oidc";
    case Samlp = "samlp";
}
