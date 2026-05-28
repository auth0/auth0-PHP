<?php

namespace Auth0\SDK\API\Management\UserGrants;

use Auth0\SDK\API\Management\UserGrants\Requests\ListUserGrantsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserGrant;
use Auth0\SDK\API\Management\UserGrants\Requests\DeleteUserGrantByUserIdRequestParameters;

interface UserGrantsClientInterface
{
    /**
     * Retrieve the [grants](https://auth0.com/docs/api-auth/which-oauth-flow-to-use) associated with your account.
     *
     * @param ListUserGrantsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserGrant>
     */
    public function list(ListUserGrantsRequestParameters $request = new ListUserGrantsRequestParameters(), ?array $options = null): Pager;

    /**
     * Delete a grant associated with your account.
     *
     * @param DeleteUserGrantByUserIdRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function deleteByUserId(DeleteUserGrantByUserIdRequestParameters $request, ?array $options = null): void;

    /**
     * Delete a grant associated with your account.
     *
     * @param string $id ID of the grant to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;
}
