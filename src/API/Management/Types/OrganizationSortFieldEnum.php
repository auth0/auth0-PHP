<?php

namespace Auth0\SDK\API\Management\Types;

enum OrganizationSortFieldEnum: string
{
    case Name = "name";
    case DisplayName = "display_name";
    case CreatedAt = "created_at";
}
