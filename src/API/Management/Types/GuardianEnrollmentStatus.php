<?php

namespace Auth0\SDK\API\Management\Types;

enum GuardianEnrollmentStatus: string
{
    case Pending = "pending";
    case Confirmed = "confirmed";
}
