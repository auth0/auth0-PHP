<?php

namespace Auth0\SDK\API\Management\Types;

enum CustomDomainStatusFilterEnum: string
{
    case PendingVerification = "pending_verification";
    case Ready = "ready";
    case Failed = "failed";
}
