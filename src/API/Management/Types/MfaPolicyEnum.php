<?php

namespace Auth0\SDK\API\Management\Types;

enum MfaPolicyEnum: string
{
    case AllApplications = "all-applications";
    case ConfidenceScore = "confidence-score";
}
