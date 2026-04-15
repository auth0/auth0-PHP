<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientTokenExchangeTypeEnum: string
{
    case CustomAuthentication = "custom_authentication";
    case OnBehalfOfTokenExchange = "on_behalf_of_token_exchange";
}
