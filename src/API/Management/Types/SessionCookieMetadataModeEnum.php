<?php

namespace Auth0\SDK\API\Management\Types;

enum SessionCookieMetadataModeEnum: string
{
    case NonPersistent = "non-persistent";
    case Persistent = "persistent";
}
