<?php

namespace Auth0\SDK\API\Management\Types;

enum FlowActionHttpSendRequestParamsMethod: string
{
    case Get = "GET";
    case Post = "POST";
    case Put = "PUT";
    case Patch = "PATCH";
    case Delete = "DELETE";
}
