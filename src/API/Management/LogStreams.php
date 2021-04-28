<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class LogStreams.
 * Handles requests to the Log Streams endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Log_Streams
 *
 * @package Auth0\SDK\API\Management
 */
class LogStreams extends GenericResource
{
    /**
     * Get all Log Streams.
     * Required scope: `read:log_streams`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams
     */
    public function getAll(
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('log-streams')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a single Log Stream.
     * Required scope: `read:log_streams`
     *
     * @param string              $id      Log Stream ID to query.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('log-streams', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a new Log Stream.
     * Required scope: `create:log_streams`
     *
     * @param string              $type    The type of log stream being created.
     * @param array               $sink    The type of log stream determines the properties required in the sink payload; see the linked documentation.
     * @param string|null         $name    Optional. The name of the log stream.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/post_log_streams
     */
    public function create(
        string $type,
        array $sink,
        ?string $name = null,
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'type' => $type,
            'sink' => $sink
        ];

        if (null !== $name) {
            $payload['name'] = $name;
        }

        return $this->apiClient->method('post')
            ->addPath('log-streams')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Updates an existing Log Stream.
     * Required scope: `update:log_streams`
     *
     * @param string              $id      ID of the Log Stream to update.
     * @param array               $query   Log Stream data to update. Only certain fields are update-able; see the linked documentation.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/patch_log_streams_by_id
     */
    public function update(
        string $id,
        array $query,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('patch')
            ->addPath('log-streams', $id)
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Deletes a Log Stream.
     * Required scope: `delete:log_streams`
     *
     * @param string              $id      ID of the Log Stream to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/delete_log_streams_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('log-streams', $id)
            ->withOptions($options)
            ->call();
    }
}
