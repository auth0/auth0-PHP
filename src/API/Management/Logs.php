<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Logs.
 * Handles requests to the Logs endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Logs
 */
class Logs extends GenericResource
{
    /**
     * Retrieves log entries that match the specified search criteria (or list all entries if no criteria is used).
     * Required scope: `read:logs`
     *
     * @param array               $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Logs/get_logs
     */
    public function getAll(
        array $parameters = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('get')
            ->addPath('logs')
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve an individual log event.
     * Required scope: `read:logs`
     *
     * @param string              $id      Log entry ID to get.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Logs/get_logs_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
            ->addPath('logs', $id)
            ->withOptions($options)
            ->call();
    }
}
