<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\GrantsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Grants.
 * Handles requests to the Grants endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Grants
 */
final class Grants extends ManagementEndpoint implements GrantsInterface
{
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        /* @var array<int|string|null> $parameters */

        return $this->getHttpClient()->
            method('get')->
            addPath('grants')->
            withParams($parameters)->
            withOptions($options)->
            call();
    }

    public function getAllByClientId(
        string $clientId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$clientId] = Toolkit::filter([$clientId])->string()->trim();
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        Toolkit::assert([
            [$clientId, \Auth0\SDK\Exception\ArgumentException::missing('clientId')],
        ])->isString();

        /** @var array<int|string|null> $parameters */
        /** @var array<int|string|null> $params */
        $params = Toolkit::merge([
            'client_id' => $clientId,
        ], $parameters);

        return $this->getAll($params, $options);
    }

    public function getAllByAudience(
        string $audience,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$audience] = Toolkit::filter([$audience])->string()->trim();
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        Toolkit::assert([
            [$audience, \Auth0\SDK\Exception\ArgumentException::missing('audience')],
        ])->isString();

        /** @var array<int|string|null> $parameters */
        /** @var array<int|string|null> $params */
        $params = Toolkit::merge([
            'audience' => $audience,
        ], $parameters);

        return $this->getAll($params, $options);
    }

    public function getAllByUserId(
        string $userId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$userId] = Toolkit::filter([$userId])->string()->trim();
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        Toolkit::assert([
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
        ])->isString();

        /** @var array<int|string|null> $parameters */
        /** @var array<int|string|null> $params */
        $params = Toolkit::merge([
            'user_id' => $userId,
        ], $parameters);

        return $this->getAll($params, $options);
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
            addPath('grants', $id)->
            withOptions($options)->
            call();
    }
}
