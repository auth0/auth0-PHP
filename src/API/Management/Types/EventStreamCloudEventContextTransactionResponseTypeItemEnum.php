<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventContextTransactionResponseTypeItemEnum: string
{
    case Code = "code";
    case Token = "token";
    case IdToken = "id_token";
}
