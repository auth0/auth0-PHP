<?php

namespace Auth0\SDK\API\Management\Types;

enum PasswordDictionaryMatchTypeEnum: string
{
    case Exact = "exact";
    case Substring = "substring";
}
