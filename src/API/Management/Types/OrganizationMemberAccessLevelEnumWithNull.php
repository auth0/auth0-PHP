<?php

namespace Auth0\SDK\API\Management\Types;

enum OrganizationMemberAccessLevelEnumWithNull: string
{
    case None = "none";
    case Readonly_ = "readonly";
    case Limited = "limited";
    case Full = "full";
}
