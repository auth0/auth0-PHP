<?php

namespace Auth0\SDK\API\Management\UserBlocks;

use Auth0\SDK\API\Management\UserBlocks\Requests\ListUserBlocksByIdentifierRequestParameters;
use Auth0\SDK\API\Management\Types\ListUserBlocksByIdentifierResponseContent;
use Auth0\SDK\API\Management\UserBlocks\Requests\DeleteUserBlocksByIdentifierRequestParameters;
use Auth0\SDK\API\Management\UserBlocks\Requests\ListUserBlocksRequestParameters;
use Auth0\SDK\API\Management\Types\ListUserBlocksResponseContent;

interface UserBlocksClientInterface
{
    /**
     * Retrieve details of all <a href="https://auth0.com/docs/secure/attack-protection/brute-force-protection">Brute-force Protection</a> blocks for a user with the given identifier (username, phone number, or email).
     *
     * @param ListUserBlocksByIdentifierRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListUserBlocksByIdentifierResponseContent
     */
    public function listByIdentifier(ListUserBlocksByIdentifierRequestParameters $request, ?array $options = null): ?ListUserBlocksByIdentifierResponseContent;

    /**
     * Remove all <a href="https://auth0.com/docs/secure/attack-protection/brute-force-protection">Brute-force Protection</a> blocks for the user with the given identifier (username, phone number, or email).
     *
     * Note: This endpoint does not unblock users that were <a href="https://auth0.com/docs/user-profile#block-and-unblock-a-user">blocked by a tenant administrator</a>.
     *
     * @param DeleteUserBlocksByIdentifierRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function deleteByIdentifier(DeleteUserBlocksByIdentifierRequestParameters $request, ?array $options = null): void;

    /**
     * Retrieve details of all <a href="https://auth0.com/docs/secure/attack-protection/brute-force-protection">Brute-force Protection</a> blocks for the user with the given ID.
     *
     * @param string $id user_id of the user blocks to retrieve.
     * @param ListUserBlocksRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListUserBlocksResponseContent
     */
    public function list(string $id, ListUserBlocksRequestParameters $request = new ListUserBlocksRequestParameters(), ?array $options = null): ?ListUserBlocksResponseContent;

    /**
     * Remove all <a href="https://auth0.com/docs/secure/attack-protection/brute-force-protection">Brute-force Protection</a> blocks for the user with the given ID.
     *
     * Note: This endpoint does not unblock users that were <a href="https://auth0.com/docs/user-profile#block-and-unblock-a-user">blocked by a tenant administrator</a>.
     *
     * @param string $id The user_id of the user to update.
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
