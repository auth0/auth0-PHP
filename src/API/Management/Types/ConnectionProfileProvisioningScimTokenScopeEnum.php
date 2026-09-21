<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionProfileProvisioningScimTokenScopeEnum: string
{
    case GetUsers = "get:users";
    case PostUsers = "post:users";
    case PatchUsers = "patch:users";
    case DeleteUsers = "delete:users";
    case PutUsers = "put:users";
}
