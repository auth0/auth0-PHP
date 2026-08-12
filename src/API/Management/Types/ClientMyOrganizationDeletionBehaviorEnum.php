<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientMyOrganizationDeletionBehaviorEnum: string
{
    case Allow = "allow";
    case AllowIfEmpty = "allow_if_empty";
}
