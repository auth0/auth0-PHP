<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventConnectionCreatedObject2OptionsSetUserRootAttributesEnum: string
{
    case OnEachLogin = "on_each_login";
    case OnFirstLogin = "on_first_login";
    case NeverOnLogin = "never_on_login";
}
