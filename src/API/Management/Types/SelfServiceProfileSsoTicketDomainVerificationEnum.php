<?php

namespace Auth0\SDK\API\Management\Types;

enum SelfServiceProfileSsoTicketDomainVerificationEnum: string
{
    case None = "none";
    case Optional = "optional";
    case Required = "required";
}
