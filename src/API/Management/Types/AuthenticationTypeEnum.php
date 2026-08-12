<?php

namespace Auth0\SDK\API\Management\Types;

enum AuthenticationTypeEnum: string
{
    case Phone = "phone";
    case Email = "email";
    case Totp = "totp";
}
