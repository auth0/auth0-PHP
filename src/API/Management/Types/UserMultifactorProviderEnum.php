<?php

namespace Auth0\SDK\API\Management\Types;

enum UserMultifactorProviderEnum: string
{
    case Duo = "duo";
    case GoogleAuthenticator = "google-authenticator";
}
