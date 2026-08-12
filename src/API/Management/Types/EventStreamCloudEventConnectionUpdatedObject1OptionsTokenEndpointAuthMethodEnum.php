<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventConnectionUpdatedObject1OptionsTokenEndpointAuthMethodEnum: string
{
    case ClientSecretPost = "client_secret_post";
    case PrivateKeyJwt = "private_key_jwt";
}
