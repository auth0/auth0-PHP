<?php

namespace Auth0\SDK\API\Management\Types;

enum PasswordCharacterTypeRulePolicyEnum: string
{
    case All = "all";
    case ThreeOfFour = "three_of_four";
}
