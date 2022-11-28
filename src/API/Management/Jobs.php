<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\JobsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Jobs.
 * Handles requests to the Jobs endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Jobs
 */
final class Jobs extends ManagementEndpoint implements JobsInterface
{
    public function createImportUsers(
        string $filePath,
        string $connectionId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$filePath, $connectionId] = Toolkit::filter([$filePath, $connectionId])->string()->trim();
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        Toolkit::assert([
            [$filePath, \Auth0\SDK\Exception\ArgumentException::missing('filePath')],
            [$connectionId, \Auth0\SDK\Exception\ArgumentException::missing('connectionId')],
        ])->isString();

        /* @var array<bool|int|string> $parameters */

        return $this->getHttpClient()->
            method('post')->
            addPath('jobs', 'users-imports')->
            addFile('users', $filePath)->
            withFormParam('connection_id', $connectionId)->
            withFormParams($parameters)->
            withOptions($options)->
            call();
    }

    public function createExportUsers(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('post')->
            addPath('jobs', 'users-exports')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function createSendVerificationEmail(
        string $userId,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$userId] = Toolkit::filter([$userId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
        ])->isString();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('jobs', 'verification-email')->
            withBody(
                (object) Toolkit::merge([
                    'user_id' => $userId,
                ], $body),
            )->
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
            addPath('jobs', $id)->
            withOptions($options)->
            call();
    }

    public function getErrors(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('jobs', $id, 'errors')->
            withOptions($options)->
            call();
    }
}
