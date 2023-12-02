<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

interface ClientGrantsInterface
{
    /**
     * Create a new Client Grant.
     * Required scope: `create:client_grants`.
     *
     * @param string              $clientId             client ID to receive the grant
     * @param string              $audience             audience identifier for the API being granted
     * @param null|array<string>  $scope                Optional. Scopes allowed for this client grant.
     * @param null|RequestOptions $options              Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     * @param null|string         $organizationUsage    Optional. Defines whether organizations can be used with client credentials exchanges for this grant. Possible values are `deny`, `allow` or `require`.
     * @param null|bool           $allowAnyOrganization Optional. If enabled, any organization can be used with this grant. If disabled (default), the grant must be explicitly assigned to the desired organizations.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `clientId` or `audience` are provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/post_client_grants
     */
    public function create(
        string $clientId,
        string $audience,
        ?array $scope = null,
        ?RequestOptions $options = null,
        ?string $organizationUsage = null,
        ?bool $allowAnyOrganization = null,
    ): ResponseInterface;

    /**
     * Delete a Client Grant by ID.
     * Required scope: `delete:client_grants`.
     *
     * @param string              $grantId grant (by it's ID) to delete
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `grantId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/delete_client_grants_by_id
     */
    public function delete(
        string $grantId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve client grants, by page if desired.
     * Required scope: `read:client_grants`.
     *
     * @param null|int[]|null[]|string[] $parameters Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param null|RequestOptions        $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
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
     * @param string                      $audience   API Audience to filter by
     * @param null|array<null|int|string> $parameters Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param null|RequestOptions         $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `audience` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
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
     * @param string                      $clientId   client ID to filter by
     * @param null|array<null|int|string> $parameters Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param null|RequestOptions         $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `clientId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAllByClientId(
        string $clientId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve a client grant's organizations.
     * Required scope: `read:organization_client_grants`.
     *
     * @param string                     $grantId    Grant (by it's ID) to update
     * @param null|int[]|null[]|string[] $parameters Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param null|RequestOptions        $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     */
    public function getOrganizations(
        string $grantId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update an existing Client Grant.
     * Required scope: `update:client_grants`.
     *
     * @param string              $grantId              Grant (by it's ID) to update
     * @param null|array<string>  $scope                Optional. Array of scopes to update; will replace existing scopes, not merge.
     * @param null|RequestOptions $options              Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     * @param null|string         $organizationUsage    Optional. Defines whether organizations can be used with client credentials exchanges for this grant. Possible values are `deny`, `allow` or `require`.
     * @param null|bool           $allowAnyOrganization Optional. If enabled, any organization can be used with this grant. If disabled (default), the grant must be explicitly assigned to the desired organizations.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `grantId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Client_Grants/patch_client_grants_by_id
     */
    public function update(
        string $grantId,
        ?array $scope = null,
        ?RequestOptions $options = null,
        ?string $organizationUsage = null,
        ?bool $allowAnyOrganization = null,
    ): ResponseInterface;
}
