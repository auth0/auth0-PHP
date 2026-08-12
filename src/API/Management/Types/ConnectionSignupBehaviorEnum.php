<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionSignupBehaviorEnum: string
{
    case Allow = "allow";
    case Block = "block";
}
