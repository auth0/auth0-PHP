<?php

namespace Auth0\SDK\API\Management\Types;

enum FlowActionHttpSendRequestParamsContentType: string
{
    case Json = "JSON";
    case Form = "FORM";
    case Xml = "XML";
}
