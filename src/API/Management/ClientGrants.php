<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\ClientGrantsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ClientGrants.
 * Handles requests to the Client Grants endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Client_Grants
 */
final class ClientGrants extends ManagementEndpoint implements ClientGrantsInterface
{
    public function create(
        string $clientId,
        string $audience,
        ?array $scope = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$clientId, $audience] = Toolkit::filter([$clientId, $audience])->string()->trim();
        [$scope] = Toolkit::filter([$scope])->array()->trim();

        Toolkit::assert([
            [$clientId, \Auth0\SDK\Exception\ArgumentException::missing('clientId')],
            [$audience, \Auth0\SDK\Exception\ArgumentException::missing('audience')],
        ])->isString();

        return $this->getHttpClient()->
            method('post')->
            addPath('client-grants')->
            withBody(
                (object) [
                    'client_id' => $clientId,
                    'audience'  => $audience,
                    'scope'     => $scope,
                ],
            )->
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
            addPath('client-grants')->
            withParams($parameters)->
            withOptions($options)->
            call();
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
        $params = Toolkit::merge([
            'audience' => $audience,
        ], $parameters);

        /* @var array<int|string|null> $params */

        return $this->getAll($params, $options);
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
        $params = Toolkit::merge([
            'client_id' => $clientId,
        ], $parameters);

        /* @var array<int|string|null> $params */

        return $this->getAll($params, $options);
    }

    public function update(
        string $grantId,
        ?array $scope = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$grantId] = Toolkit::filter([$grantId])->string()->trim();
        [$scope] = Toolkit::filter([$scope])->array()->trim();

        Toolkit::assert([
            [$grantId, \Auth0\SDK\Exception\ArgumentException::missing('grantId')],
        ])->isString();

        return $this->getHttpClient()->
            method('patch')->
            addPath('client-grants', $grantId)->
            withBody(
                (object) [
                    'scope' => $scope,
                ],
            )->
            withOptions($options)->
            call();
    }

    public function delete(
        string $grantId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$grantId] = Toolkit::filter([$grantId])->string()->trim();

        Toolkit::assert([
            [$grantId, \Auth0\SDK\Exception\ArgumentException::missing('grantId')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('client-grants', $grantId)->
            withOptions($options)->
            call();
    }
}
