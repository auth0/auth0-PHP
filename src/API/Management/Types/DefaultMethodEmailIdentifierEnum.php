<?php

namespace Auth0\SDK\API\Management\Types;

enum DefaultMethodEmailIdentifierEnum: string
{
    case Password = "password";
    case EmailOtp = "email_otp";
}
