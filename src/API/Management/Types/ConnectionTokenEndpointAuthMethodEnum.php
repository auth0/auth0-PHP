<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionTokenEndpointAuthMethodEnum: string
{
    case ClientSecretPost = "client_secret_post";
    case PrivateKeyJwt = "private_key_jwt";
}
