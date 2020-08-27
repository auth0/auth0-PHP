<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\EmptyOrInvalidParameterException;

/**
 * Class LogStreams.
 * Access to the v2 Management API Log Streams endpoint.
 *
 * @package Auth0\SDK\API\Management
 */
class LogStreams extends GenericResource {

    private const LOG_STREAMS_PATH = 'log-streams';

    /**
     * Get all Log Streams.
     * Required scope: "read:log_streams"
     *
     * @return mixed
     *
     * @throws \Exception Thrown by Guzzle for API errors.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams
     */
    public function getAll()
    {
        return $this->apiClient->method('get')
            ->addPath(self::LOG_STREAMS_PATH)
            ->call();
    }

    /**
     * Get a single Log Stream.
     * Required scope: "read:log_streams"
     *
     * @param string $log_stream_id Log Stream ID to get.
     *
     * @return mixed
     *
     * @throws \Exception Thrown by Guzzle for API errors.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams_by_id
     */
    public function get($log_stream_id)
    {
        $this->checkEmptyOrInvalidString($log_stream_id, 'log_stream_id');

        return $this->apiClient->method('get')
            ->addPath(self::LOG_STREAMS_PATH, $log_stream_id)
            ->call();
    }

    /**
     * Create a new Log Stream.
     * Required scope: "create:log_streams"
     *
     * @param array $data Log Stream data to create:
     *      - "name" if not specified, a name of the Log Stream will be assigned by the Log Stream endpoint.
     *      - "type" field is required.
     *      - "sink" field is required. It's value and requirements depends upon the type of Log Stream to create; see the linked documentation below.
     *
     * @return mixed
     *
     * @throws EmptyOrInvalidParameterException Thrown if any required parameters are empty or invalid.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/post_log_streams
     */
    public function create(array $data)
    {
        if (empty($data)) {
            throw new EmptyOrInvalidParameterException('Missing required "data" parameter.');
        }

        if (empty($data['type'])) {
            throw new EmptyOrInvalidParameterException('Missing required "type" field.');
        }

        if (empty($data['sink'])) {
            throw new EmptyOrInvalidParameterException('Missing required "sink" field.');
        }

        return $this->apiClient->method('post')
            ->addPath(self::LOG_STREAMS_PATH)
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Updates an existing Log Stream.
     * Required scope: "update:log_streams"
     *
     * @param string $log_stream_id the ID of the Log Stream to update.
     * @param array  $data Log Stream data to update. Only certain fields are update-able; see the documentation linked below.
     *
     * @return mixed
     *
     * @throws EmptyOrInvalidParameterException Thrown if the log_stream_id parameter is empty.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/patch_log_streams_by_id
     */
    public function update($log_stream_id, array $data)
    {
        if (empty($log_stream_id)) {
            throw new EmptyOrInvalidParameterException('Missing required "log_stream_id" field');
        }

        return $this->apiClient->method('patch')
            ->addPath(self::LOG_STREAMS_PATH, $log_stream_id)
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Deletes a Log Stream.
     * Required scope: "delete:log_streams"
     *
     * @param string $log_stream_id the ID of the Log Stream to delete.
     *
     * @return mixed
     *
     * @throws EmptyOrInvalidParameterException Thrown if the log_stream_id parameter is empty.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/delete_log_streams_by_id
     */
    public function delete($log_stream_id)
    {
        if (empty($log_stream_id)) {
            throw new EmptyOrInvalidParameterException('Missing required "log_stream_id" field');
        }

        return $this->apiClient->method('delete')
            ->addPath(self::LOG_STREAMS_PATH, $log_stream_id)
            ->call();
    }

}
