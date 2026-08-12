<?php

namespace Auth0\SDK\API\Management\Types;

enum VerificationMethodEnum: string
{
    case Link = "link";
    case Otp = "otp";
}
