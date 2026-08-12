<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientComplianceLevelEnum: string
{
    case None = "none";
    case Fapi1AdvPkjPar = "fapi1_adv_pkj_par";
    case Fapi1AdvMtlsPar = "fapi1_adv_mtls_par";
    case Fapi2SpPkjMtls = "fapi2_sp_pkj_mtls";
    case Fapi2SpMtlsMtls = "fapi2_sp_mtls_mtls";
}
