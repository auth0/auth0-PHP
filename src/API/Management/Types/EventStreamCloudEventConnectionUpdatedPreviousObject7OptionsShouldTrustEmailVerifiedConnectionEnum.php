<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventConnectionUpdatedPreviousObject7OptionsShouldTrustEmailVerifiedConnectionEnum: string
{
    case NeverSetEmailsAsVerified = "never_set_emails_as_verified";
    case AlwaysSetEmailsAsVerified = "always_set_emails_as_verified";
}
