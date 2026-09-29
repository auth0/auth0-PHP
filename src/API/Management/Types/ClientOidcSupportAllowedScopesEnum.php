<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientOidcSupportAllowedScopesEnum: string
{
    case Profile = "profile";
    case Email = "email";
    case Address = "address";
    case Phone = "phone";
}
