<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ClientGrants.
 * Handles requests to the Client Grants endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Client_Grants
 */
final class ClientGrants extends ManagementEndpoint
{
    /**
     * Create a new Client Grant.
     * Required scope: `create:client_grants`
     *
     * @param string              $clientId Client ID to receive the grant.
     * @param string              $audience Audience identifier for the API being granted.
     * @param array<string>|null  $scope    Optional. Scopes allowed for this client grant.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `clientId` or `audience` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/post_client_grants
     */
    public function create(
        string $clientId,
        string $audience,
        ?array $scope = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$clientId, $audience] = Toolkit::filter([$clientId, $audience])->string()->trim();
        [$scope] = Toolkit::filter([$scope])->array()->trim();

        Toolkit::assert([
            [$clientId, \Auth0\SDK\Exception\ArgumentException::missing('clientId')],
            [$audience, \Auth0\SDK\Exception\ArgumentException::missing('audience')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('client-grants')
            ->withBody(
                (object) [
                    'client_id' => $clientId,
                    'audience' => $audience,
                    'scope' => $scope,
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve client grants, by page if desired.
     * Required scope: `read:client_grants`
     *
     * @param array<int|string|null> $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null    $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('client-grants')
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get Client Grants by audience.
     * Required scope: `read:client_grants`
     *
     * @param string                      $audience   API Audience to filter by.
     * @param array<int|string|null>|null $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null         $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `audience` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAllByAudience(
        string $audience,
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$audience] = Toolkit::filter([$audience])->string()->trim();
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        Toolkit::assert([
            [$audience, \Auth0\SDK\Exception\ArgumentException::missing('audience')],
        ])->isString();

        return $this->getAll(Toolkit::merge([
            'audience' => $audience,
        ], $parameters), $options);
    }

    /**
     * Get Client Grants by Client ID.
     * Required scope: `read:client_grants`
     *
     * @param string                      $clientId   Client ID to filter by.
     * @param array<int|string|null>|null $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null         $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `clientId` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAllByClientId(
        string $clientId,
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$clientId] = Toolkit::filter([$clientId])->string()->trim();
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        Toolkit::assert([
            [$clientId, \Auth0\SDK\Exception\ArgumentException::missing('clientId')],
        ])->isString();

        return $this->getAll(Toolkit::merge([
            'client_id' => $clientId,
        ], $parameters), $options);
    }

    /**
     * Update an existing Client Grant.
     * Required scope: `update:client_grants`
     *
     * @param string              $grantId Grant (by it's ID) to update.
     * @param array<string>|null  $scope   Optional. Array of scopes to update; will replace existing scopes, not merge.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `grantId` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/patch_client_grants_by_id
     */
    public function update(
        string $grantId,
        ?array $scope = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$grantId] = Toolkit::filter([$grantId])->string()->trim();
        [$scope] = Toolkit::filter([$scope])->array()->trim();

        Toolkit::assert([
            [$grantId, \Auth0\SDK\Exception\ArgumentException::missing('grantId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('client-grants', $grantId)
            ->withBody(
                (object) [
                    'scope' => $scope,
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a Client Grant by ID.
     * Required scope: `delete:client_grants`
     *
     * @param string              $grantId Grant (by it's ID) to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `grantId` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/delete_client_grants_by_id
     */
    public function delete(
        string $grantId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$grantId] = Toolkit::filter([$grantId])->string()->trim();

        Toolkit::assert([
            [$grantId, \Auth0\SDK\Exception\ArgumentException::missing('grantId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('client-grants', $grantId)
            ->withOptions($options)
            ->call();
    }
}
