<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\ActionsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Actions.
 * Handles requests to the Actions endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Actions
 */
final class Actions extends ManagementEndpoint implements ActionsInterface
{
    public function create(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('post')->
            addPath('actions', 'actions')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        /* @var array<int|string|null> $parameters */

        return $this->getHttpClient()->
            method('get')->
            addPath('actions', 'actions')->
            withParams($parameters)->
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
            addPath('actions', 'actions', $id)->
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
            addPath('actions', 'actions', $id)->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function delete(
        string $id,
        ?bool $force = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        $params = Toolkit::filter([
            [
                'force' => $force,
            ],
        ])->array()->trim()[0];

        /* @var array<int|string|null> $params */

        return $this->getHttpClient()->
            method('delete')->
            addPath('actions', 'actions', $id)->
            withParams($params)->
            withOptions($options)->
            call();
    }

    public function deploy(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('post')->
            addPath('actions', $id, 'deploy')->
            withOptions($options)->
            call();
    }

    public function test(
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
            method('post')->
            addPath('actions', 'actions', $id, 'test')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function getVersion(
        string $id,
        string $actionId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $actionId] = Toolkit::filter([$id, $actionId])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$actionId, \Auth0\SDK\Exception\ArgumentException::missing('actionId')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('actions', $actionId, 'versions', $id)->
            withOptions($options)->
            call();
    }

    public function getVersions(
        string $actionId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$actionId] = Toolkit::filter([$actionId])->string()->trim();

        Toolkit::assert([
            [$actionId, \Auth0\SDK\Exception\ArgumentException::missing('actionId')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('actions', $actionId, 'versions')->
            withOptions($options)->
            call();
    }

    public function rollbackVersion(
        string $id,
        string $actionId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$actionId, $id] = Toolkit::filter([$actionId, $id])->string()->trim();

        Toolkit::assert([
            [$actionId, \Auth0\SDK\Exception\ArgumentException::missing('actionId')],
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('post')->
            addPath('actions', $actionId, 'versions', $id, 'deploy')->
            withOptions($options)->
            call();
    }

    public function getTriggers(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('actions', 'triggers')->
            withOptions($options)->
            call();
    }

    public function getTriggerBindings(
        string $triggerId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$triggerId] = Toolkit::filter([$triggerId])->string()->trim();

        Toolkit::assert([
            [$triggerId, \Auth0\SDK\Exception\ArgumentException::missing('triggerId')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('actions', 'triggers', $triggerId, 'bindings')->
            withOptions($options)->
            call();
    }

    public function updateTriggerBindings(
        string $triggerId,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$triggerId] = Toolkit::filter([$triggerId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$triggerId, \Auth0\SDK\Exception\ArgumentException::missing('triggerId')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('patch')->
            addPath('actions', 'triggers', $triggerId, 'bindings')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function getExecution(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('actions', 'executions', $id)->
            withOptions($options)->
            call();
    }
}
