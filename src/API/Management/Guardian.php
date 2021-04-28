<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Guardian.
 * Handles requests to the Guardian endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Guardian
 *
 * @package Auth0\SDK\API\Management
 */
class Guardian extends GenericResource
{

    /**
     * Retrieve all multi-factor authentication configurations.
     * Required scope: `read:guardian_factors`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @see https://auth0.com/docs/api/management/v2#!/Guardian/get_factors
     */
    public function getFactors(
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('guardian', 'factors')
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve an enrollment (including its status and type).
     * Required scope: `read:guardian_enrollments`
     *
     * @param string              $enrollmentId ID of the enrollment to be retrieved.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @see https://auth0.com/docs/api/management/v2#!/Guardian/get_enrollments_by_id
     */
    public function getEnrollment(
        string $enrollmentId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('guardian', 'enrollments', $enrollmentId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete an enrollment to allow the user to enroll with multi-factor authentication again.
     * Required scope: `delete:guardian_enrollments`
     *
     * @param string              $enrollmentId ID of the enrollment to be deleted.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @see https://auth0.com/docs/api/management/v2#!/Guardian/delete_enrollments_by_id
     */
    public function deleteEnrollment(
        string $enrollmentId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('guardian', 'enrollments', $enrollmentId)
            ->withOptions($options)
            ->call();
    }
}
