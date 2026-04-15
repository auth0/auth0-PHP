<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionConnectionSettingsPkceEnum: string
{
    case Auto = "auto";
    case S256 = "S256";
    case Plain = "plain";
    case Disabled = "disabled";
}
