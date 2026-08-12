<?php

namespace Auth0\SDK\API\Management\Types;

enum SelfServiceProfileSsoTicketProvisioningScopeEnum: string
{
    case GetUsers = "get:users";
    case PostUsers = "post:users";
    case PutUsers = "put:users";
    case PatchUsers = "patch:users";
    case DeleteUsers = "delete:users";
    case GetGroups = "get:groups";
    case PostGroups = "post:groups";
    case PutGroups = "put:groups";
    case PatchGroups = "patch:groups";
    case DeleteGroups = "delete:groups";
}
