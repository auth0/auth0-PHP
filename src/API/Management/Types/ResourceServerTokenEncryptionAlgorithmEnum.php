<?php

namespace Auth0\SDK\API\Management\Types;

enum ResourceServerTokenEncryptionAlgorithmEnum: string
{
    case RsaOaep256 = "RSA-OAEP-256";
    case RsaOaep384 = "RSA-OAEP-384";
    case RsaOaep512 = "RSA-OAEP-512";
}
