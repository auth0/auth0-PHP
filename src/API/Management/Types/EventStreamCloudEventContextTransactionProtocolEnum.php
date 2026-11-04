<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventContextTransactionProtocolEnum: string
{
    case OidcBasicProfile = "oidc-basic-profile";
    case OidcImplicitProfile = "oidc-implicit-profile";
    case Oauth2DeviceCode = "oauth2-device-code";
    case Oauth2ResourceOwner = "oauth2-resource-owner";
    case Oauth2ResourceOwnerJwtBearer = "oauth2-resource-owner-jwt-bearer";
    case Oauth2Password = "oauth2-password";
    case Oauth2Webauthn = "oauth2-webauthn";
    case Oauth2AccessToken = "oauth2-access-token";
    case Oauth2RefreshToken = "oauth2-refresh-token";
    case Oauth2TokenExchange = "oauth2-token-exchange";
    case OidcHybridProfile = "oidc-hybrid-profile";
    case Samlp = "samlp";
    case Wsfed = "wsfed";
    case WstrustUsernamemixed = "wstrust-usernamemixed";
}
