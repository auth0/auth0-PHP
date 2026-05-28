<?php

namespace Auth0\SDK\API\Management\Organizations\Members;

use Auth0\SDK\API\Management\Organizations\Members\Requests\ListOrganizationMembersRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationMember;
use Auth0\SDK\API\Management\Organizations\Members\Requests\CreateOrganizationMemberRequestContent;
use Auth0\SDK\API\Management\Organizations\Members\Requests\DeleteOrganizationMembersRequestContent;
use Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\EffectiveRolesClientInterface;
use Auth0\SDK\API\Management\Organizations\Members\Roles\RolesClientInterface;

interface MembersClientInterface
{
    /**
     * List organization members.
     * This endpoint is subject to eventual consistency. New users may not be immediately included in the response and deleted users may not be immediately removed from it.
     *
     * - Use the `fields` parameter to optionally define the specific member details retrieved. If `fields` is left blank, all fields (except roles) are returned.
     * - Member roles are not sent by default. Use `fields=roles` to retrieve the roles assigned to each listed member. To use this parameter, you must include the `read:organization_member_roles` scope in the token.
     *
     * This endpoint supports two types of pagination:
     *
     * - Offset pagination
     * - Checkpoint pagination
     *
     * Checkpoint pagination must be used if you need to retrieve more than 1000 organization members.
     *
     * **Checkpoint Pagination**
     *
     * To search by checkpoint, use the following parameters: - from: Optional id from which to start selection. - take: The total amount of entries to retrieve when using the from parameter. Defaults to 50. Note: The first time you call this endpoint using Checkpoint Pagination, you should omit the `from` parameter. If there are more results, a `next` value will be included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, this indicates there are no more pages remaining.
     *
     * @param string $id Organization identifier.
     * @param ListOrganizationMembersRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationMember>
     */
    public function list(string $id, ListOrganizationMembersRequestParameters $request = new ListOrganizationMembersRequestParameters(), ?array $options = null): Pager;

    /**
     * Set one or more existing users as members of a specific [Organization](https://auth0.com/docs/manage-users/organizations).
     *
     * To add a user to an Organization through this action, the user must already exist in your tenant. If a user does not yet exist, you can [invite them to create an account](https://auth0.com/docs/manage-users/organizations/configure-organizations/invite-members), manually create them through the Auth0 Dashboard, or use the Management API.
     *
     * @param string $id Organization identifier.
     * @param CreateOrganizationMemberRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function create(string $id, CreateOrganizationMemberRequestContent $request, ?array $options = null): void;

    /**
     * @param string $id Organization identifier.
     * @param DeleteOrganizationMembersRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, DeleteOrganizationMembersRequestContent $request, ?array $options = null): void;

    /**
     * @return EffectiveRolesClientInterface
     */
    public function getEffectiveRoles(): EffectiveRolesClientInterface;

    /**
     * @return RolesClientInterface
     */
    public function getRoles(): RolesClientInterface;
}
