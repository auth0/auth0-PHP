<?php

namespace Auth0\SDK\API\Management\Groups\Members;

use Auth0\SDK\API\Management\Groups\Members\Requests\GetGroupMembersRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\GroupMember;

interface MembersClientInterface
{
    /**
     * List all users that are a member of this group.
     *
     * Example:
     * ```php
     * $client->groups->members->get(
     *     'id',
     *     new GetGroupMembersRequestParameters([
     *         'fields' => 'fields',
     *         'includeFields' => true,
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param string $id Unique identifier for the group (service-generated).
     * @param GetGroupMembersRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<GroupMember>
     */
    public function get(string $id, GetGroupMembersRequestParameters $request = new GetGroupMembersRequestParameters(), ?array $options = null): Pager;
}
