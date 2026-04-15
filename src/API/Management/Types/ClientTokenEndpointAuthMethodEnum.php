<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientTokenEndpointAuthMethodEnum: string
{
    case None = "none";
    case ClientSecretPost = "client_secret_post";
    case ClientSecretBasic = "client_secret_basic";
}
