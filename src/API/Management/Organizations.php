<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Organizations
 * Handles requests to the Organizations endpoints of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Organizations
 */
final class Organizations extends ManagementEndpoint
{
    /**
     * Create an organization.
     * Required scope: `create:organizations`
     *
     * @param string              $name        The name of the Organization. Cannot be changed later.
     * @param string              $displayName The displayed name of the Organization.
     * @param array|null          $branding    An array containing branding customizations for the organization.
     * @param array|null          $metadata    Optional. Additional metadata to store about the organization.
     * @param array               $body        Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function create(
        string $name,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        array $body = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($name, 'name');
        $this->validateString($displayName, 'displayName');

        $payload = array_filter(
            [
                'name' => $name,
                'display_name' => $displayName,
                'branding' => $branding ? (object) $branding : null,
                'metadata' => $metadata ? (object) $metadata : null,
            ] + $body
        );

        return $this->apiClient->method('post')
            ->addPath('organizations')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * List available organizations.
     * Required scope: `read:organizations`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getAll(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('get')
            ->addPath('organizations')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a specific organization.
     * Required scope: `read:organizations`
     *
     * @param string              $id      Organization (by ID) to retrieve details for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
            ->addPath('organizations', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get details about an organization, queried by it's `name`.
     * Required scope: `read:organizations`
     *
     * @param string              $name    Organization (by name parameter provided during creation) to retrieve details for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getByName(
        string $name,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($name, 'name');

        return $this->apiClient->method('get')
            ->addPath('organizations', 'name', $name)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update an organization.
     * Required scope: `update:organizations`
     *
     * @param string               $id          Organization (by ID) to update.
     * @param string               $displayName The displayed name of the Organization.
     * @param array|null           $branding    An array containing branding customizations for the organization.
     * @param array|null           $metadata    Optional. Additional metadata to store about the organization.
     * @param array                $body        Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null  $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function update(
        string $id,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        array $body = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($displayName, 'displayName');

        $payload = array_filter(
            [
                'display_name' => $displayName,
                'branding' => $branding ? (object) $branding : null,
                'metadata' => $metadata ? (object) $metadata : null,
            ] + $body
        );

        return $this->apiClient->method('patch')
            ->addPath('organizations', $id)
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete an organization.
     * Required scope: `delete:organizations`
     *
     * @param string              $id      Organization (by ID) to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('delete')
            ->addPath('organizations', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Add a connection to an organization.
     * Required scope: `create:organization_connections`
     *
     * @param string              $id           Organization (by ID) to add a connection to.
     * @param string              $connectionId Connection (by ID) to add to organization.
     * @param array               $body         Additional body content to send with the API request. See @link for supported options.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function addEnabledConnection(
        string $id,
        string $connectionId,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($connectionId, 'connectionId');

        $payload = [
            'connection_id' => $connectionId,
        ] + $body;

        return $this->apiClient->method('post')
            ->addPath('organizations', $id, 'enabled_connections')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * List the enabled connections associated with an organization.
     * Required scope: `read:organization_connections`
     *
     * @param string              $id      Organization (by ID) to list connections of.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getEnabledConnections(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
            ->addPath('organizations', $id, 'enabled_connections')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a connection (by ID) associated with an organization.
     * Required scope: `read:organization_connections`
     *
     * @param string              $id           Organization (by ID) that the connection is associated with.
     * @param string              $connectionId Connection (by ID) to retrieve details for.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getEnabledConnection(
        string $id,
        string $connectionId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($connectionId, 'connectionId');

        return $this->apiClient->method('get')
            ->addPath('organizations', $id, 'enabled_connections', $connectionId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a connection to an organization.
     * Required scope: `update:organization_connections`
     *
     * @param string              $id           Organization (by ID) to add a connection to.
     * @param string              $connectionId Connection (by ID) to add to organization.
     * @param array               $body         Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function updateEnabledConnection(
        string $id,
        string $connectionId,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($connectionId, 'connectionId');

        return $this->apiClient->method('patch')
            ->addPath('organizations', $id, 'enabled_connections', $connectionId)
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Remove a connection from an organization.
     * Required scope: `delete:organization_connections`
     *
     * @param string              $id           Organization (by ID) to remove connection from.
     * @param string              $connectionId Connection (by ID) to remove from organization.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function removeEnabledConnection(
        string $id,
        string $connectionId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($connectionId, 'connectionId');

        return $this->apiClient->method('delete')
            ->addPath('organizations', $id, 'enabled_connections', $connectionId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Add one or more users to an organization as members.
     * Required scope: `update:organization_members`
     *
     * @param string              $id      Organization (by ID) to add new members to.
     * @param array               $members One or more users (by ID) to add from the organization.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function addMembers(
        string $id,
        array $members,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateArray($members, 'members');

        $payload = [
            'members' => $members,
        ];

        return $this->apiClient->method('post')
            ->addPath('organizations', $id, 'members')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * List the members (users) belonging to an organization
     * Required scope: `read:organization_members`
     *
     * @param string              $id      Organization (by ID) to list members of.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getMembers(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
            ->addPath('organizations', $id, 'members')
            ->withOptions($options)
            ->call();
    }

    /**
     * Remove one or more members (users) from an organization.
     * Required scope: `delete:organization_members`
     *
     * @param string              $id      Organization (by ID) users belong to.
     * @param array               $members One or more users (by ID) to remove from the organization.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function removeMembers(
        string $id,
        array $members,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateArray($members, 'members');

        $payload = [
            'members' => $members,
        ];

        return $this->apiClient->method('delete')
            ->addPath('organizations', $id, 'members')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Add one or more roles to a member (user) in an organization.
     * Required scope: `create:organization_member_roles`
     *
     * @param string              $id      Organization (by ID) user belongs to.
     * @param string              $userId  User (by ID) to add roles to.
     * @param array<string>       $roles   One or more roles (by ID) to add to the user.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function addMemberRoles(
        string $id,
        string $userId,
        array $roles,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($userId, 'userId');
        $this->validateArray($roles, 'roles');

        $payload = [
            'roles' => $roles,
        ];

        return $this->apiClient->method('post')
            ->addPath('organizations', $id, 'members', $userId, 'roles')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * List the roles a member (user) in an organization currently has.
     * Required scope: `read:organization_member_roles`
     *
     * @param string              $id      Organization (by ID) user belongs to.
     * @param string              $userId  User (by ID) to add role to.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getMemberRoles(
        string $id,
        string $userId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($userId, 'userId');

        return $this->apiClient->method('get')
            ->addPath('organizations', $id, 'members', $userId, 'roles')
            ->withOptions($options)
            ->call();
    }

    /**
     * Remove one or more roles from a member (user) in an organization.
     * Required scope: `delete:organization_member_roles`
     *
     * @param string              $id      Organization (by ID) user belongs to.
     * @param string              $userId  User (by ID) to remove roles from.
     * @param array<string>       $roles   One or more roles (by ID) to remove from the user.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function removeMemberRoles(
        string $id,
        string $userId,
        array $roles,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($userId, 'userId');
        $this->validateArray($roles, 'roles');

        $payload = [
            'roles' => $roles,
        ];

        return $this->apiClient->method('delete')
            ->addPath('organizations', $id, 'members', $userId, 'roles')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create an invitation for an organization
     * Required scope: `create:organization_invitations`
     *
     * @param string              $id       Organization (by ID) to create the invitation for.
     * @param string              $clientId Client (by ID) to create the invitation for. This Client must be associated with the Organization.
     * @param array               $inviter  An array containing information about the inviter. Requires a 'name' key minimally.
     *                                      - 'name' Required. A name to identify who is sending the invitation.
     * @param array               $invitee  An array containing information about the invitee. Requires an 'email' key.
     *                                      - 'email' Required. An email address where the invitation should be sent.
     * @param array               $body     Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function createInvitation(
        string $id,
        string $clientId,
        array $inviter,
        array $invitee,
        array $body = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($clientId, 'clientId');
        $this->validateArray($inviter, 'inviter');
        $this->validateArray($invitee, 'invitee');

        if (! isset($inviter['name'])) {
            throw new \Auth0\SDK\Exception\EmptyOrInvalidParameterException('inviter');
        }

        if (! isset($invitee['email'])) {
            throw new \Auth0\SDK\Exception\EmptyOrInvalidParameterException('invitee');
        }

        $payload = array_filter(
            [
                'client_id' => $clientId,
                'inviter' => (object) $inviter,
                'invitee' => (object) $invitee,
            ] + $body
        );

        return $this->apiClient->method('post')
            ->addPath('organizations', $id, 'invitations')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * List invitations for an organization
     * Required scope: `read:organization_invitations`
     *
     * @param string              $id      Organization (by ID) to list invitations for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getInvitations(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
            ->addPath('organizations', $id, 'invitations')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get an invitation (by ID) for an organization
     * Required scope: `read:organization_invitations`
     *
     * @param string              $id           Organization (by ID) to request.
     * @param string              $invitationId Invitation (by ID) to request.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getInvitation(
        string $id,
        string $invitationId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($invitationId, 'invitationId');

        return $this->apiClient->method('get')
            ->addPath('organizations', $id, 'invitations', $invitationId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete an invitation (by ID) for an organization
     * Required scope: `delete:organization_invitations`
     *
     * @param string              $id           Organization (by ID) to request.
     * @param string              $invitationId Invitation (by ID) to request.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function deleteInvitation(
        string $id,
        string $invitationId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateString($invitationId, 'invitation');

        return $this->apiClient->method('delete')
            ->addPath('organizations', $id, 'invitations', $invitationId)
            ->withOptions($options)
            ->call();
    }
}
