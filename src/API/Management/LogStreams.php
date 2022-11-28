<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\LogStreamsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class LogStreams.
 * Handles requests to the Log Streams endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Log_Streams
 */
final class LogStreams extends ManagementEndpoint implements LogStreamsInterface
{
    public function create(
        string $type,
        array $sink,
        ?string $name = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$type, $name] = Toolkit::filter([$type, $name])->string()->trim();
        [$sink] = Toolkit::filter([$sink])->array()->trim();

        Toolkit::assert([
            [$type, \Auth0\SDK\Exception\ArgumentException::missing('type')],
        ])->isString();

        Toolkit::assert([
            [$sink, \Auth0\SDK\Exception\ArgumentException::missing('sink')],
        ])->isArray();

        return $this->getHttpClient()->
            method('post')->
            addPath('log-streams')->
            withBody(
                (object) Toolkit::filter([
                    [
                        'type' => $type,
                        'sink' => (object) $sink,
                        'name' => $name,
                    ],
                ])->array()->trim()[0],
            )->
            withOptions($options)->
            call();
    }

    public function getAll(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('log-streams')->
            withOptions($options)->
            call();
    }

    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('log-streams', $id)->
            withOptions($options)->
            call();
    }

    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('patch')->
            addPath('log-streams', $id)->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('log-streams', $id)->
            withOptions($options)->
            call();
    }
}
