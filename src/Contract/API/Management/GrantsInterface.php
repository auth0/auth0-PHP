<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface GrantsInterface.
 */
interface GrantsInterface
{
    /**
     * Retrieve the grants associated with your account.
     * Required scope: `read:grants`.
     *
     * @param  array<string,int|string|null>|null  $parameters  Optional. Query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get Grants by Client ID with pagination.
     * Required scope: `read:grants`.
     *
     * @param  string  $clientId  client ID to filter Grants
     * @param  array<string,int|string|null>|null  $parameters  Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `clientId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getAllByClientId(
        string $clientId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get Grants by Audience with pagination.
     * Required scope: `read:grants`.
     *
     * @param  string  $audience  audience to filter Grants
     * @param  array<string,int|string|null>|null  $parameters  Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `audience` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getAllByAudience(
        string $audience,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get Grants by User ID with pagination.
     * Required scope: `read:grants`.
     *
     * @param  string  $userId  user ID to filter Grants
     * @param  array<string,int|string|null>|null  $parameters  Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `userId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getAllByUserId(
        string $userId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete a grant by Grant ID or User ID.
     * Required scope: `delete:grants`.
     *
     * @param  string  $id  grant ID to delete a single Grant or User ID to delete all Grants for a User
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Grants/delete_grants_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
