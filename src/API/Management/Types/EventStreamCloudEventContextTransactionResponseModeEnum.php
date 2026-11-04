<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventContextTransactionResponseModeEnum: string
{
    case Query = "query";
    case Fragment = "fragment";
    case FormPost = "form_post";
    case WebMessage = "web_message";
}
