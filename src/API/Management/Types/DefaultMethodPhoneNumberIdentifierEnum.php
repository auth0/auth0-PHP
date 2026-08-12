<?php

namespace Auth0\SDK\API\Management\Types;

enum DefaultMethodPhoneNumberIdentifierEnum: string
{
    case Password = "password";
    case PhoneOtp = "phone_otp";
}
