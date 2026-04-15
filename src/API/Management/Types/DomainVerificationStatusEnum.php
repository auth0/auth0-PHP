<?php

namespace Auth0\SDK\API\Management\Types;

enum DomainVerificationStatusEnum: string
{
    case Verified = "verified";
    case Pending = "pending";
    case Failed = "failed";
}
