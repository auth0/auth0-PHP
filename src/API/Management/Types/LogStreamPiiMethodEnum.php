<?php

namespace Auth0\SDK\API\Management\Types;

enum LogStreamPiiMethodEnum: string
{
    case Mask = "mask";
    case Hash = "hash";
}
