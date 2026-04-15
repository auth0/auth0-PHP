<?php

namespace Auth0\SDK\API\Management\Types;

enum UserEnrollmentStatusEnum: string
{
    case Pending = "pending";
    case Confirmed = "confirmed";
}
