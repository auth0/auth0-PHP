<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientCredentialTypeEnum: string
{
    case PublicKey = "public_key";
    case CertSubjectDn = "cert_subject_dn";
    case X509Cert = "x509_cert";
}
