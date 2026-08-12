<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionMappingModeEnumOidc: string
{
    case BindAll = "bind_all";
    case UseMap = "use_map";
}
