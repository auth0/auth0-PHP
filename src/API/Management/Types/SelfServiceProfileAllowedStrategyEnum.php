<?php

namespace Auth0\SDK\API\Management\Types;

enum SelfServiceProfileAllowedStrategyEnum: string
{
    case Oidc = "oidc";
    case Samlp = "samlp";
    case Waad = "waad";
    case GoogleApps = "google-apps";
    case Adfs = "adfs";
    case Okta = "okta";
    case Auth0Samlp = "auth0-samlp";
    case OktaSamlp = "okta-samlp";
    case KeycloakSamlp = "keycloak-samlp";
    case Pingfederate = "pingfederate";
}
