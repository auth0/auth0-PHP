<?php

namespace Auth0\SDK\API\Management\Types;

enum LogStreamHttpContentFormatEnum: string
{
    case Jsonarray = "JSONARRAY";
    case Jsonlines = "JSONLINES";
    case Jsonobject = "JSONOBJECT";
}
