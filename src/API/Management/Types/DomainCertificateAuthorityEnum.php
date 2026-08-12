<?php

namespace Auth0\SDK\API\Management\Types;

enum DomainCertificateAuthorityEnum: string
{
    case Letsencrypt = "letsencrypt";
    case Googletrust = "googletrust";
}
