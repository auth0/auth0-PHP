<?php
namespace Auth0\SDK\API\Management;

/**
 * Class Guardian
 *
 * @package Auth0\SDK\API\Management
 */
class Guardian extends GenericResource
{

    /**
     * Retrieve all multi-factor authentication configurations.
     * Required scope: "read:guardian_factors"
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/management/v2#!/Guardian/get_factors
     */
    public function getFactors()
    {
        return $this->apiClient->method('get')
            ->addPath('guardian', 'factors')
            ->call();
    }

    /**
     * Retrieve an enrollment (including its status and type).
     * Required scope: "read:guardian_enrollments"
     *
     * @param string $id ID of the enrollment to be retrieved.
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/management/v2#!/Guardian/get_enrollments_by_id
     */
    public function getEnrollment(string $id)
    {
        return $this->apiClient->method('get')
            ->addPath('guardian', 'enrollments', $id)
            ->call();
    }

    /**
     * Delete an enrollment to allow the user to enroll with multi-factor authentication again.
     * Required scope: "delete:guardian_enrollments"
     *
     * @param string $id ID of the enrollment to be deleted.
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/management/v2#!/Guardian/delete_enrollments_by_id
     */
    public function deleteEnrollment(string $id)
    {
        return $this->apiClient->method('delete')
            ->addPath('guardian', 'enrollments', $id)
            ->call();
    }
}
