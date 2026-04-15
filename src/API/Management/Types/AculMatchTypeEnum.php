<?php

namespace Auth0\SDK\API\Management\Types;

enum AculMatchTypeEnum: string
{
    case IncludesAny = "includes_any";
    case ExcludesAny = "excludes_any";
}
