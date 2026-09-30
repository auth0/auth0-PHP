<?php

namespace Auth0\SDK\API\Management\Types;

enum FeatureFlagStatusEnum: string
{
    case Draft = "draft";
    case Active = "active";
    case Archived = "archived";
}
