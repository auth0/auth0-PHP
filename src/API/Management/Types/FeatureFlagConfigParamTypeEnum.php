<?php

namespace Auth0\SDK\API\Management\Types;

enum FeatureFlagConfigParamTypeEnum: string
{
    case String = "string";
    case Boolean = "boolean";
    case Number = "number";
    case Array = "array";
    case Object = "object";
}
