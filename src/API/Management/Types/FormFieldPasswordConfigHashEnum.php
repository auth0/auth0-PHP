<?php

namespace Auth0\SDK\API\Management\Types;

enum FormFieldPasswordConfigHashEnum: string
{
    case None = "NONE";
    case Md5 = "MD5";
    case Sha1 = "SHA1";
    case Sha256 = "SHA256";
    case Sha512 = "SHA512";
}
