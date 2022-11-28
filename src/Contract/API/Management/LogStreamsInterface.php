<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface LogStreamsInterface.
 */
interface LogStreamsInterface
{
    /**
     * Create a new Log Stream.
     * Required scope: `create:log_streams`.
     *
     * @param  string  $type  the type of log stream being created
     * @param  array<string>  $sink  the type of log stream determines the properties required in the sink payload; see the linked documentation
     * @param  string|null  $name  Optional. The name of the log stream.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `type` or `sink` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Log_Streams/post_log_streams
     */
    public function create(
        string $type,
        array $sink,
        ?string $name = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get all Log Streams.
     * Required scope: `read:log_streams`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams
     */
    public function getAll(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get a single Log Stream.
     * Required scope: `read:log_streams`.
     *
     * @param  string  $id  log Stream ID to query
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Updates an existing Log Stream.
     * Required scope: `update:log_streams`.
     *
     * @param  string  $id  ID of the Log Stream to update
     * @param  array<mixed>  $body  Log Stream data to update. Only certain fields are update-able; see the linked documentation.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Log_Streams/patch_log_streams_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Deletes a Log Stream.
     * Required scope: `delete:log_streams`.
     *
     * @param  string  $id  ID of the Log Stream to delete
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Log_Streams/delete_log_streams_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
