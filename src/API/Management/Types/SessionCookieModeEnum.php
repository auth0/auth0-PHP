<?php

namespace Auth0\SDK\API\Management\Types;

enum SessionCookieModeEnum: string
{
    case Persistent = "persistent";
    case NonPersistent = "non-persistent";
}
