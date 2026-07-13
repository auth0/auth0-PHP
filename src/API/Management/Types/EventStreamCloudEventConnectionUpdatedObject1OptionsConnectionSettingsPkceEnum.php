<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventConnectionUpdatedObject1OptionsConnectionSettingsPkceEnum: string
{
    case Auto = "auto";
    case S256 = "S256";
    case Plain = "plain";
    case Disabled = "disabled";
}
