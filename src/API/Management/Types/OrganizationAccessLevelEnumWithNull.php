<?php

namespace Auth0\SDK\API\Management\Types;

enum OrganizationAccessLevelEnumWithNull: string
{
    case None = "none";
    case Readonly_ = "readonly";
    case Limited = "limited";
    case Full = "full";
}
