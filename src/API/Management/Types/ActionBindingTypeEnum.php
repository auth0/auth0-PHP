<?php

namespace Auth0\SDK\API\Management\Types;

enum ActionBindingTypeEnum: string
{
    case TriggerBound = "trigger-bound";
    case EntityBound = "entity-bound";
}
