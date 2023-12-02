<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\ClientGrantsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
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
        ?string $organizationUsage = null,
        ?bool $allowAnyOrganization = null,
    ): ResponseInterface {
        [$clientId, $audience] = Toolkit::filter([$clientId, $audience])->string()->trim();
        [$scope] = Toolkit::filter([$scope])->array()->trim();

        Toolkit::assert([
            [$clientId, \Auth0\SDK\Exception\ArgumentException::missing('clientId')],
            [$audience, \Auth0\SDK\Exception\ArgumentException::missing('audience')],
        ])->isString();

        $body = [
            'client_id' => $clientId,
            'audience' => $audience,
            'scope' => $scope,
        ];

        if (null !== $organizationUsage) {
            $body['organization_usage'] = $organizationUsage;
        }

        if (null !== $allowAnyOrganization) {
            $body['allow_any_organization'] = $allowAnyOrganization;
        }

        return $this->getHttpClient()
            ->method('post')
            ->addPath(['client-grants'])
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    public function delete(
        string $grantId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$grantId] = Toolkit::filter([$grantId])->string()->trim();

        Toolkit::assert([
            [$grantId, \Auth0\SDK\Exception\ArgumentException::missing('grantId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')->addPath(['client-grants', $grantId])
            ->withOptions($options)
            ->call();
    }

    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        /** @var array<null|int|string> $parameters */

        return $this->getHttpClient()
            ->method('get')
            ->addPath(['client-grants'])
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
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

        /** @var array<null|int|string> $parameters */
        $params = Toolkit::merge([[
            'audience' => $audience,
        ], $parameters]);

        /** @var array<null|int|string> $params */

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

        /** @var array<null|int|string> $parameters */
        $params = Toolkit::merge([[
            'client_id' => $clientId,
        ], $parameters]);

        /** @var array<null|int|string> $params */

        return $this->getAll($params, $options);
    }

    public function getOrganizations(
        string $grantId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$grantId] = Toolkit::filter([$grantId])->string()->trim();
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        Toolkit::assert([
            [$grantId, \Auth0\SDK\Exception\ArgumentException::missing('grantId')],
        ])->isString();

        /** @var array<null|int|string> $parameters */

        return $this->getHttpClient()
            ->method('get')
            ->addPath(['client-grants', $grantId, 'organizations'])
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    public function update(
        string $grantId,
        ?array $scope = null,
        ?RequestOptions $options = null,
        ?string $organizationUsage = null,
        ?bool $allowAnyOrganization = null,
    ): ResponseInterface {
        [$grantId] = Toolkit::filter([$grantId])->string()->trim();
        [$scope] = Toolkit::filter([$scope])->array()->trim();

        Toolkit::assert([
            [$grantId, \Auth0\SDK\Exception\ArgumentException::missing('grantId')],
        ])->isString();

        $body = [
            'scope' => $scope,
        ];

        if (null !== $organizationUsage) {
            $body['organization_usage'] = $organizationUsage;
        }

        if (null !== $allowAnyOrganization) {
            $body['allow_any_organization'] = $allowAnyOrganization;
        }

        return $this->getHttpClient()
            ->method('patch')->addPath(['client-grants', $grantId])
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }
}
