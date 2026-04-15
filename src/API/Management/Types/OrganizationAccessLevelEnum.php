<?php

namespace Auth0\SDK\API\Management\Types;

enum OrganizationAccessLevelEnum: string
{
    case None = "none";
    case Readonly_ = "readonly";
    case Limited = "limited";
    case Full = "full";
}
