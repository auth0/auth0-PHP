<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientOrganizationRequireBehaviorPatchEnum: string
{
    case NoPrompt = "no_prompt";
    case PreLoginPrompt = "pre_login_prompt";
    case PostLoginPrompt = "post_login_prompt";
}
