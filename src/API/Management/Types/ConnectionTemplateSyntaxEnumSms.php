<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionTemplateSyntaxEnumSms: string
{
    case Liquid = "liquid";
    case MdWithMacros = "md_with_macros";
}
