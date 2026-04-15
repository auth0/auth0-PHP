<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionPasskeyChallengeUiEnum: string
{
    case Both = "both";
    case Autofill = "autofill";
    case Button = "button";
}
