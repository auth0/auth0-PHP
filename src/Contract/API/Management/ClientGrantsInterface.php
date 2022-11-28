<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ClientGrantsInterface.
 */
interface ClientGrantsInterface
{
    /**
     * Create a new Client Grant.
     * Required scope: `create:client_grants`.
     *
     * @param  string  $clientId  client ID to receive the grant
     * @param  string  $audience  audience identifier for the API being granted
     * @param  array<string>|null  $scope  Optional. Scopes allowed for this client grant.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `clientId` or `audience` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/post_client_grants
     */
    public function create(
        string $clientId,
        string $audience,
        ?array $scope = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve client grants, by page if desired.
     * Required scope: `read:client_grants`.
     *
     * @param  array<int|string|null>  $parameters  Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get Client Grants by audience.
     * Required scope: `read:client_grants`.
     *
     * @param  string  $audience  API Audience to filter by
     * @param  array<int|string|null>|null  $parameters  Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `audience` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAllByAudience(
        string $audience,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get Client Grants by Client ID.
     * Required scope: `read:client_grants`.
     *
     * @param  string  $clientId  client ID to filter by
     * @param  array<int|string|null>|null  $parameters  Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `clientId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAllByClientId(
        string $clientId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update an existing Client Grant.
     * Required scope: `update:client_grants`.
     *
     * @param  string  $grantId  grant (by it's ID) to update
     * @param  array<string>|null  $scope  Optional. Array of scopes to update; will replace existing scopes, not merge.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `grantId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/patch_client_grants_by_id
     */
    public function update(
        string $grantId,
        ?array $scope = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete a Client Grant by ID.
     * Required scope: `delete:client_grants`.
     *
     * @param  string  $grantId  grant (by it's ID) to delete
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `grantId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/delete_client_grants_by_id
     */
    public function delete(
        string $grantId,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
