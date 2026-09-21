<?php

namespace Auth0\SDK\API\Management\Types;

enum OrganizationTemplateAllowedStrategyEnum: string
{
    case Adfs = "adfs";
    case GoogleApps = "google-apps";
    case Oidc = "oidc";
    case Okta = "okta";
    case Pingfederate = "pingfederate";
    case Samlp = "samlp";
    case Waad = "waad";
}
