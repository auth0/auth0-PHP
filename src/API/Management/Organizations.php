<?php

namespace Auth0\SDK\API\Management;

use GuzzleHttp\Exception\RequestException;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;

/**
 * Organizations
 * Handles requests to the Organizations endpoints of the v2 Management API.
 *
 * @package Auth0\SDK\API\Management
 */
class Organizations extends GenericResource
{

    /**
     * Create an organization.
     * Required scope: "create:organizations"
     *
     * @param string                   $name        The name of the Organization. Cannot be changed later.
     * @param string                   $displayName The displayed name of the Organization.
     * @param null|array<string,mixed> $branding    An array containing branding customizations for the organization.
     * @param null|array<string,mixed> $metadata    Optional. Additional metadata to store about the organization.
     * @param array<string,mixed>      $params      Optional. Additional parameters to send with the API request.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function create(
        string $name,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        array $params = []
    )
    {
        $this->checkEmptyOrInvalidString($name, 'name');
        $this->checkEmptyOrInvalidString($displayName, 'displayName');

        $payload = (object) array_filter([
            'name'         => $name,
            'display_name' => $displayName,
            'branding'     => $branding ? (object) $branding : null,
            'metadata'     => $metadata ? (object) $metadata : null,
        ] + $params);

        return $this->apiClient->method('post')
            ->addPath('organizations')
            ->withBody(json_encode($payload))
            ->call();
    }

    /**
     * Update an organization.
     * Required scope: "update:organizations"
     *
     * @param string                   $organization Organization (by ID) to update.
     * @param string                   $displayName  The displayed name of the Organization.
     * @param null|array<string,mixed> $branding     An array containing branding customizations for the organization.
     * @param null|array<string,mixed> $metadata     Optional. Additional metadata to store about the organization.
     * @param array<string,mixed>      $params       Optional. Additional parameters to send with the API request.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function update(
        string $organization,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        array $params = []
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($displayName, 'displayName');

        $payload = (object) array_filter([
            'display_name' => $displayName,
            'branding'     => $branding ? (object) $branding : null,
            'metadata'     => $metadata ? (object) $metadata : null,
        ] + $params);

        return $this->apiClient->method('patch')
            ->addPath('organizations', $organization)
            ->withBody(json_encode($payload))
            ->call();
    }

    /**
     * Delete an organization.
     * Required scope: "delete:organizations"
     *
     * @param string $organization Organization (by ID) to delete.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function delete(
        string $organization
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');

        return $this->apiClient->method('delete')
            ->addPath('organizations', $organization)
            ->call();
    }

    /**
     * List all organizations.
     * Required scope: "read:organizations"
     *
     * @param array<string,mixed> $params Optional. Options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function getAll(
        array $params = []
    )
    {
        return $this->apiClient->method('get')
            ->addPath('organizations')
            ->withDictParams($this->normalizeRequest($params))
            ->call();
    }

    /**
     * Get details about an organization, queried by it's ID.
     * Required scope: "read:organizations"
     *
     * @param string $organization Organization (by ID) to retrieve details for.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function get(
        string $organization
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');

        return $this->apiClient->method('get')
            ->addPath('organizations', $organization)
            ->call();
    }

    /**
     * Get details about an organization, queried by it's `name`.
     * Required scope: "read:organizations"
     *
     * @param string $organizationName Organization (by name parameter provided during creation) to retrieve details for.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function getByName(
        string $organizationName
    )
    {
        $this->checkEmptyOrInvalidString($organizationName, 'organizationName');

        return $this->apiClient->method('get')
            ->addPath('organizations', 'name', $organizationName)
            ->call();
    }

    /**
     * List the enabled connections associated with an organization.
     * Required scope: "read:organization_connections"
     *
     * @param string              $organization Organization (by ID) to list connections of.
     * @param array<string,mixed> $params       Optional. Additional options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function getEnabledConnections(
        string $organization,
        array $params = []
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');

        return $this->apiClient->method('get')
            ->addPath('organizations', $organization, 'enabled_connections')
            ->withDictParams($this->normalizeRequest($params))
            ->call();
    }

    /**
     * Get a connection (by ID) associated with an organization.
     * Required scope: "read:organization_connections"
     *
     * @param string $organization Organization (by ID) that the connection is associated with.
     * @param string $connection   Connection (by ID) to retrieve details for.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function getEnabledConnection(
        string $organization,
        string $connection
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($connection, 'connection');

        return $this->apiClient->method('get')
            ->addPath('organizations', $organization, 'enabled_connections', $connection)
            ->call();
    }

    /**
     * Add a connection to an organization.
     * Required scope: "create:organization_connections"
     *
     * @param string              $organization Organization (by ID) to add a connection to.
     * @param string              $connection   Connection (by ID) to add to organization.
     * @param array<string,mixed> $params       Optional. Additional parameters to send with the API request.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function addEnabledConnection(
        string $organization,
        string $connection,
        array $params = []
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($connection, 'connection');

        $payload = (object) array_filter([
            'connection_id' => $connection
        ] + $params);

        return $this->apiClient->method('post')
            ->addPath('organizations', $organization, 'enabled_connections')
            ->withBody(json_encode($payload))
            ->call();
    }

    /**
     * Update a connection to an organization.
     * Required scope: "update:organization_connections"
     *
     * @param string              $organization Organization (by ID) to add a connection to.
     * @param string              $connection   Connection (by ID) to add to organization.
     * @param array<string,mixed> $params       Optional. Additional parameters to send with the API request.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function updateEnabledConnection(
        string $organization,
        string $connection,
        array $params = []
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($connection, 'connection');

        return $this->apiClient->method('patch')
            ->addPath('organizations', $organization, 'enabled_connections', $connection)
            ->withBody(json_encode( (object) $params))
            ->call();
    }

    /**
     * Remove a connection from an organization.
     * Required scope: "delete:organization_connections"
     *
     * @param string $organization Organization (by ID) to remove connection from.
     * @param string $connection   Connection (by ID) to remove from organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function removeEnabledConnection(
        string $organization,
        string $connection
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($connection, 'connection');

        return $this->apiClient->method('delete')
            ->addPath('organizations', $organization, 'enabled_connections', $connection)
            ->call();
    }

    /**
     * List the members (users) belonging to an organization
     * Required scope: "read:organization_members"
     *
     * @param string              $organization Organization (by ID) to list members of.
     * @param array<string,mixed> $params       Optional. Additional options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function getMembers(
        string $organization,
        array $params = []
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');

        return $this->apiClient->method('get')
            ->addPath('organizations', $organization, 'members')
            ->withDictParams($this->normalizeRequest($params))
            ->call();
    }

    /**
     * Add one or more users to an organization as members.
     * Required scope: "update:organization_members"
     *
     * @param string $organization Organization (by ID) to add new members to.
     * @param array  $users        One or more users (by ID) to add from the organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function addMembers(
        string $organization,
        array $users
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidArray($users, 'users');

        $payload = [
            'members' => $users
        ];

        return $this->apiClient->method('post')
            ->addPath('organizations', $organization, 'members')
            ->withBody(json_encode($payload))
            ->call();
    }

    /**
     * Remove one or more members (users) from an organization.
     * Required scope: "delete:organization_members"
     *
     * @param string $organization Organization (by ID) users belong to.
     * @param array  $users        One or more users (by ID) to remove from the organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function removeMembers(
        string $organization,
        array $users
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidArray($users, 'users');

        $payload = [
            'members' => $users
        ];

        return $this->apiClient->method('delete')
            ->addPath('organizations', $organization, 'members')
            ->withBody(json_encode($payload))
            ->call();
    }

    /**
     * List the roles a member (user) in an organization currently has.
     * Required scope: "read:organization_member_roles"
     *
     * @param string              $organization Organization (by ID) user belongs to.
     * @param string              $user         User (by ID) to add role to.
     * @param array<string,mixed> $params       Optional. Additional options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function getMemberRoles(
        string $organization,
        string $user,
        array $params = []
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($user, 'user');

        return $this->apiClient->method('get')
            ->addPath('organizations', $organization, 'members', $user, 'roles')
            ->withDictParams($this->normalizeRequest($params))
            ->call();
    }

    /**
     * Add one or more roles to a member (user) in an organization.
     * Required scope: "create:organization_member_roles"
     *
     * @param string        $organization Organization (by ID) user belongs to.
     * @param string        $user         User (by ID) to add roles to.
     * @param array<string> $roles        One or more roles (by ID) to add to the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function addMemberRoles(
        string $organization,
        string $user,
        array $roles
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($user, 'user');
        $this->checkEmptyOrInvalidArray($roles, 'roles');

        $payload = [
            'roles' => $roles
        ];

        return $this->apiClient->method('post')
            ->addPath('organizations', $organization, 'members', $user, 'roles')
            ->withBody(json_encode($payload))
            ->call();
    }

    /**
     * Remove one or more roles from a member (user) in an organization.
     * Required scope: "delete:organization_member_roles"
     *
     * @param string        $organization Organization (by ID) user belongs to.
     * @param string        $user         User (by ID) to remove roles from.
     * @param array<string> $roles        One or more roles (by ID) to remove from the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function removeMemberRoles(
        string $organization,
        string $user,
        array $roles
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($user, 'user');
        $this->checkEmptyOrInvalidArray($roles, 'roles');

        $payload = [
            'roles' => $roles
        ];

        return $this->apiClient->method('delete')
            ->addPath('organizations', $organization, 'members', $user, 'roles')
            ->withBody(json_encode($payload))
            ->call();
    }

    /**
     * List invitations for an organization
     * Required scope: "read:organization_invitations"
     *
     * @param string              $organization Organization (by ID) to list invitations for.
     * @param array<string,mixed> $params       Optional. Options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function getInvitations(
        string $organization,
        array $params = []
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');

        return $this->apiClient->method('get')
            ->addPath('organizations', $organization, 'invitations')
            ->withDictParams($this->normalizeRequest($params))
            ->call();
    }

    /**
     * Get an invitation (by ID) for an organization
     * Required scope: "read:organization_invitations"
     *
     * @param string $organization Organization (by ID) to request.
     * @param string $invitation   Invitation (by ID) to request.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function getInvitation(
        string $organization,
        string $invitation
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($invitation, 'invitation');

        return $this->apiClient->method('get')
            ->addPath('organizations', $organization, 'invitations', $invitation)
            ->call();
    }

    /**
     * Create an invitation for an organization
     * Required scope: "create:organization_invitations"
     *
     * @param string              $organization Organization (by ID) to create the invitation for.
     * @param string              $clientId     Client (by ID) to create the invitation for. This Client must be associated with the Organization.
     * @param array<string,mixed> $inviter      An array containing information about the inviter. Requires a 'name' key minimally.
     *                                          - 'name' Required. A name to identify who is sending the invitation.
     * @param array<string,mixed> $invitee      An array containing information about the invitee. Requires an 'email' key.
     *                                          - 'email' Required. An email address where the invitation should be sent.
     * @param array<string,mixed> $params       Optional. Options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function createInvitation(
        string $organization,
        string $clientId,
        array $inviter,
        array $invitee,
        array $params = []
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($clientId, 'clientId');
        $this->checkEmptyOrInvalidArray($inviter, 'inviter');
        $this->checkEmptyOrInvalidArray($invitee, 'invitee');

        if (! isset($inviter['name'])) {
            throw new EmptyOrInvalidParameterException('inviter');
        }

        if (! isset($invitee['email'])) {
            throw new EmptyOrInvalidParameterException('invitee');
        }

        $payload = (object) array_filter([
            'client_id' => $clientId,
            'inviter'   => (object) $inviter,
            'invitee'   => (object) $invitee,
        ] + $params);

        return $this->apiClient->method('post')
            ->addPath('organizations', $organization, 'invitations')
            ->withBody(json_encode($payload))
            ->call();
    }

    /**
     * Delete an invitation (by ID) for an organization
     * Required scope: "delete:organization_invitations"
     *
     * @param string $organization Organization (by ID) to request.
     * @param string $invitation   Invitation (by ID) to request.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function deleteInvitation(
        string $organization,
        string $invitation
    )
    {
        $this->checkEmptyOrInvalidString($organization, 'organization');
        $this->checkEmptyOrInvalidString($invitation, 'invitation');

        return $this->apiClient->method('delete')
            ->addPath('organizations', $organization, 'invitations', $invitation)
            ->call();
    }
}
