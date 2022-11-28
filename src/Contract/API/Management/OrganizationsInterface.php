<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface OrganizationsInterface.
 */
interface OrganizationsInterface
{
    /**
     * Create an organization.
     * Required scope: `create:organizations`.
     *
     * @param  string  $name  the name of the Organization
     * @param  string  $displayName  the displayed name of the Organization
     * @param  array<mixed>|null  $branding  Optional. An array containing branding customizations for the organization.
     * @param  array<mixed>|null  $metadata  Optional. Additional metadata to store about the organization.
     * @param  array<mixed>|null  $body  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `name` or `displayName` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/post_organizations
     */
    public function create(
        string $name,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * List available organizations.
     * Required scope: `read:organizations`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/get_organizations
     */
    public function getAll(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get a specific organization.
     * Required scope: `read:organizations`.
     *
     * @param  string  $id  organization (by ID) to retrieve details for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/get_organizations_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get details about an organization, queried by it's `name`.
     * Required scope: `read:organizations`.
     *
     * @param  string  $name  organization (by name parameter provided during creation) to retrieve details for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `name` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/get_name_by_name
     */
    public function getByName(
        string $name,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update an organization.
     * Required scope: `update:organizations`.
     *
     * @param  string  $id  organization (by ID) to update
     * @param  string  $name  the name of the Organization
     * @param  string  $displayName  the displayed name of the Organization
     * @param  array<mixed>|null  $branding  Optional. An array containing branding customizations for the organization.
     * @param  array<mixed>|null  $metadata  Optional. Additional metadata to store about the organization.
     * @param  array<mixed>|null  $body  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `displayName` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/patch_organizations_by_id
     */
    public function update(
        string $id,
        string $name,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete an organization.
     * Required scope: `delete:organizations`.
     *
     * @param  string  $id  organization (by ID) to delete
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/delete_organizations_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Add a connection to an organization.
     * Required scope: `create:organization_connections`.
     *
     * @param  string  $id  organization (by ID) to add a connection to
     * @param  string  $connectionId  connection (by ID) to add to organization
     * @param  array<mixed>  $body  Additional body content to send with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `connectionId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/post_enabled_connections
     */
    public function addEnabledConnection(
        string $id,
        string $connectionId,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * List the enabled connections associated with an organization.
     * Required scope: `read:organization_connections`.
     *
     * @param  string  $id  organization (by ID) to list connections of
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/get_enabled_connections
     */
    public function getEnabledConnections(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get a connection (by ID) associated with an organization.
     * Required scope: `read:organization_connections`.
     *
     * @param  string  $id  organization (by ID) that the connection is associated with
     * @param  string  $connectionId  connection (by ID) to retrieve details for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `connectionId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/get_enabled_connections_by_connectionId
     */
    public function getEnabledConnection(
        string $id,
        string $connectionId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update a connection to an organization.
     * Required scope: `update:organization_connections`.
     *
     * @param  string  $id  organization (by ID) to add a connection to
     * @param  string  $connectionId  connection (by ID) to add to organization
     * @param  array<mixed>  $body  Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `connectionId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/patch_enabled_connections_by_connectionId
     */
    public function updateEnabledConnection(
        string $id,
        string $connectionId,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Remove a connection from an organization.
     * Required scope: `delete:organization_connections`.
     *
     * @param  string  $id  organization (by ID) to remove connection from
     * @param  string  $connectionId  connection (by ID) to remove from organization
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `connectionId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/delete_enabled_connections_by_connectionId
     */
    public function removeEnabledConnection(
        string $id,
        string $connectionId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Add one or more users to an organization as members.
     * Required scope: `update:organization_members`.
     *
     * @param  string  $id  organization (by ID) to add new members to
     * @param  array<string>  $members  one or more users (by ID) to add from the organization
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `members` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/post_members
     */
    public function addMembers(
        string $id,
        array $members,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * List the members (users) belonging to an organization
     * Required scope: `read:organization_members`.
     *
     * @param  string  $id  organization (by ID) to list members of
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/get_members
     */
    public function getMembers(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Remove one or more members (users) from an organization.
     * Required scope: `delete:organization_members`.
     *
     * @param  string  $id  organization (by ID) users belong to
     * @param  array<string>  $members  one or more users (by ID) to remove from the organization
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `members` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/delete_members
     */
    public function removeMembers(
        string $id,
        array $members,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Add one or more roles to a member (user) in an organization.
     * Required scope: `create:organization_member_roles`.
     *
     * @param  string  $id  organization (by ID) user belongs to
     * @param  string  $userId  user (by ID) to add roles to
     * @param  array<string>  $roles  one or more roles (by ID) to add to the user
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id`, `userId`, or `roles` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/post_organization_member_roles
     */
    public function addMemberRoles(
        string $id,
        string $userId,
        array $roles,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * List the roles a member (user) in an organization currently has.
     * Required scope: `read:organization_member_roles`.
     *
     * @param  string  $id  organization (by ID) user belongs to
     * @param  string  $userId  user (by ID) to add role to
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `userId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/get_organization_member_roles
     */
    public function getMemberRoles(
        string $id,
        string $userId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Remove one or more roles from a member (user) in an organization.
     * Required scope: `delete:organization_member_roles`.
     *
     * @param  string  $id  organization (by ID) user belongs to
     * @param  string  $userId  user (by ID) to remove roles from
     * @param  array<string>  $roles  one or more roles (by ID) to remove from the user
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id`, `userId`, or `roles` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/delete_organization_member_roles
     */
    public function removeMemberRoles(
        string $id,
        string $userId,
        array $roles,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Create an invitation for an organization
     * Required scope: `create:organization_invitations`.
     *
     * @param  string  $id  organization (by ID) to create the invitation for
     * @param  string  $clientId  Client (by ID) to create the invitation for. This Client must be associated with the Organization.
     * @param  array<string>  $inviter  An array containing information about the inviter. Requires a 'name' key minimally.
     *                                  - 'name' Required. A name to identify who is sending the invitation.
     * @param  array<string>  $invitee  An array containing information about the invitee. Requires an 'email' key.
     *                                  - 'email' Required. An email address where the invitation should be sent.
     * @param  array<mixed>|null  $body  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id`, `clientId`, `inviter`, or `invitee` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/post_invitations
     */
    public function createInvitation(
        string $id,
        string $clientId,
        array $inviter,
        array $invitee,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * List invitations for an organization
     * Required scope: `read:organization_invitations`.
     *
     * @param  string  $id  organization (by ID) to list invitations for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/get_invitations
     */
    public function getInvitations(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get an invitation (by ID) for an organization
     * Required scope: `read:organization_invitations`.
     *
     * @param  string  $id  organization (by ID) to request
     * @param  string  $invitationId  invitation (by ID) to request
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `invitationId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * https://auth0.com/docs/api/management/v2#!/Organizations/get_invitations_by_invitation_id
     */
    public function getInvitation(
        string $id,
        string $invitationId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete an invitation (by ID) for an organization
     * Required scope: `delete:organization_invitations`.
     *
     * @param  string  $id  organization (by ID) to request
     * @param  string  $invitationId  invitation (by ID) to request
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `invitationId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Organizations/delete_invitations_by_invitation_id
     */
    public function deleteInvitation(
        string $id,
        string $invitationId,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
