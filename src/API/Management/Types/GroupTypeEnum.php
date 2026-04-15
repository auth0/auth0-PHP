<?php

namespace Auth0\SDK\API\Management\Types;

enum GroupTypeEnum: string
{
    case Connection = "connection";
    case Organization = "organization";
    case Tenant = "tenant";
}
