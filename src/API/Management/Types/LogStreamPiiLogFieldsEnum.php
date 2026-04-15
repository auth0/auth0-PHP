<?php

namespace Auth0\SDK\API\Management\Types;

enum LogStreamPiiLogFieldsEnum: string
{
    case FirstName = "first_name";
    case LastName = "last_name";
    case Username = "username";
    case Email = "email";
    case Phone = "phone";
    case Address = "address";
}
