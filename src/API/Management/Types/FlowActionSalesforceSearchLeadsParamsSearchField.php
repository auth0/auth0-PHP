<?php

namespace Auth0\SDK\API\Management\Types;

enum FlowActionSalesforceSearchLeadsParamsSearchField: string
{
    case Email = "email";
    case Name = "name";
    case Phone = "phone";
    case All = "all";
}
