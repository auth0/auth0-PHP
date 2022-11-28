<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface GuardianInterface.
 */
interface GuardianInterface
{
    /**
     * Retrieve all multi-factor authentication configurations.
     * Required scope: `read:guardian_factors`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Guardian/get_factors
     */
    public function getFactors(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve an enrollment (including its status and type).
     * Required scope: `read:guardian_enrollments`.
     *
     * @param  string  $id  enrollment (by it's ID) to query
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Guardian/get_enrollments_by_id
     */
    public function getEnrollment(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete an enrollment to allow the user to enroll with multi-factor authentication again.
     * Required scope: `delete:guardian_enrollments`.
     *
     * @param  string  $id  enrollment (by it's ID) to be deleted
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Guardian/delete_enrollments_by_id
     */
    public function deleteEnrollment(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
