<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionTypeEnumOidc: string
{
    case BackChannel = "back_channel";
    case FrontChannel = "front_channel";
}
