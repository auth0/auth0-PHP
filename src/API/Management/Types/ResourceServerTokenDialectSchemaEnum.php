<?php

namespace Auth0\SDK\API\Management\Types;

enum ResourceServerTokenDialectSchemaEnum: string
{
    case AccessToken = "access_token";
    case AccessTokenAuthz = "access_token_authz";
    case Rfc9068Profile = "rfc9068_profile";
    case Rfc9068ProfileAuthz = "rfc9068_profile_authz";
}
