<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Guardian.
 * Handles requests to the Guardian endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Guardian
 */
final class Guardian extends ManagementEndpoint
{
    /**
     * Retrieve all multi-factor authentication configurations.
     * Required scope: `read:guardian_factors`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Guardian/get_factors
     */
    public function getFactors(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
            ->addPath('guardian', 'factors')
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve an enrollment (including its status and type).
     * Required scope: `read:guardian_enrollments`
     *
     * @param string              $id      Enrollment (by it's ID) to query.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Guardian/get_enrollments_by_id
     */
    public function getEnrollment(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('guardian', 'enrollments', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete an enrollment to allow the user to enroll with multi-factor authentication again.
     * Required scope: `delete:guardian_enrollments`
     *
     * @param string              $id      Enrollment (by it's ID) to be deleted.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Guardian/delete_enrollments_by_id
     */
    public function deleteEnrollment(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('guardian', 'enrollments', $id)
            ->withOptions($options)
            ->call();
    }
}
