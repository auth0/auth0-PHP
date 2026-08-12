<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionIdentifierPrecedenceEnum: string
{
    case Email = "email";
    case PhoneNumber = "phone_number";
    case Username = "username";
}
