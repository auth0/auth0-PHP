<?php

namespace Auth0\SDK\API\Management\Types;

enum OrganizationTemplateRoleVisibilityEnum: string
{
    case Write = "write";
    case ReadOnly = "read_only";
    case Hidden = "hidden";
}
