<?php

namespace Auth0\SDK\API\Management\Guardian;

use Auth0\SDK\API\Management\Guardian\Enrollments\EnrollmentsClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\FactorsClientInterface;
use Auth0\SDK\API\Management\Guardian\Policies\PoliciesClientInterface;

interface GuardianClientInterface
{
    /**
     * @return EnrollmentsClientInterface
     */
    public function getEnrollments(): EnrollmentsClientInterface;

    /**
     * @return FactorsClientInterface
     */
    public function getFactors(): FactorsClientInterface;

    /**
     * @return PoliciesClientInterface
     */
    public function getPolicies(): PoliciesClientInterface;
}
