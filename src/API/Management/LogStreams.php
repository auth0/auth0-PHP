<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class LogStreams.
 * Handles requests to the Log Streams endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Log_Streams
 */
final class LogStreams extends ManagementEndpoint
{
    /**
     * Create a new Log Stream.
     * Required scope: `create:log_streams`
     *
     * @param string              $type    The type of log stream being created.
     * @param array<string>       $sink    The type of log stream determines the properties required in the sink payload; see the linked documentation.
     * @param string|null         $name    Optional. The name of the log stream.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `type` or `sink` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/post_log_streams
     */
    public function create(
        string $type,
        array $sink,
        ?string $name = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$type, $name] = Toolkit::filter([$type, $name])->string()->trim();
        [$sink] = Toolkit::filter([$sink])->array()->trim();

        Toolkit::assert([
            [$type, \Auth0\SDK\Exception\ArgumentException::missing('type')],
        ])->isString();

        Toolkit::assert([
            [$sink, \Auth0\SDK\Exception\ArgumentException::missing('sink')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('log-streams')
            ->withBody(
                (object) Toolkit::filter([
                    [
                        'type' => $type,
                        'sink' => (object) $sink,
                        'name' => $name,
                    ],
                ])->array()->trim()[0]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Get all Log Streams.
     * Required scope: `read:log_streams`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams
     */
    public function getAll(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
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
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('log-streams', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Updates an existing Log Stream.
     * Required scope: `update:log_streams`
     *
     * @param string              $id      ID of the Log Stream to update.
     * @param array<mixed>        $body    Log Stream data to update. Only certain fields are update-able; see the linked documentation.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/patch_log_streams_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('log-streams', $id)
            ->withBody((object) $body)
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
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Log_Streams/delete_log_streams_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('log-streams', $id)
            ->withOptions($options)
            ->call();
    }
}
