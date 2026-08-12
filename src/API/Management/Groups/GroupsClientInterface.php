<?php

namespace Auth0\SDK\API\Management\Groups;

use Auth0\SDK\API\Management\Groups\Requests\ListGroupsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Group;
use Auth0\SDK\API\Management\Types\GetGroupResponseContent;
use Auth0\SDK\API\Management\Groups\Members\MembersClientInterface;
use Auth0\SDK\API\Management\Groups\Roles\RolesClientInterface;

interface GroupsClientInterface
{
    /**
     * List all groups in your tenant.
     *
     * Example:
     * ```php
     * $client->groups->list(
     *     new ListGroupsRequestParameters([
     *         'connectionId' => 'connection_id',
     *         'name' => 'name',
     *         'externalId' => 'external_id',
     *         'search' => 'search',
     *         'fields' => 'fields',
     *         'includeFields' => true,
     *         'includeTotals' => true,
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListGroupsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Group>
     */
    public function list(ListGroupsRequestParameters $request = new ListGroupsRequestParameters(), ?array $options = null): Pager;

    /**
     * Retrieve a group by its ID.
     *
     * Example:
     * ```php
     * $client->groups->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id Unique identifier for the group (service-generated).
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGroupResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetGroupResponseContent;

    /**
     * Delete a group by its ID.
     *
     * Example:
     * ```php
     * $client->groups->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id Unique identifier for the group (service-generated).
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

    /**
     * @return MembersClientInterface
     */
    public function getMembers(): MembersClientInterface;

    /**
     * @return RolesClientInterface
     */
    public function getRoles(): RolesClientInterface;
}
