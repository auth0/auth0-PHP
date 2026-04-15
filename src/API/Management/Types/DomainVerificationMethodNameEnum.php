<?php

namespace Auth0\SDK\API\Management\Types;

enum DomainVerificationMethodNameEnum: string
{
    case Cname = "cname";
    case Txt = "txt";
}
