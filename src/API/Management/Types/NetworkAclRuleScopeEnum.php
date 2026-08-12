<?php

namespace Auth0\SDK\API\Management\Types;

enum NetworkAclRuleScopeEnum: string
{
    case Management = "management";
    case Authentication = "authentication";
    case Tenant = "tenant";
    case DynamicClientRegistration = "dynamic_client_registration";
}
