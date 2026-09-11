<?php

namespace Auth0\SDK\API\Management\Types;

enum SearchParserEnum: string
{
    case Scim = "scim";
    case Lucene = "lucene";
}
