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
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function get(
        string $organization
    )
    {
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
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function getByName(
        string $organizationName
    )
    {
        return $this->apiClient->method('get')
        ->addPath('organizations', 'name', $organizationName)
        ->call();
    }

    /**
     * Create an organization.
     * Required scope: "create:organizations"
     *
     * @param string              $name                 The name of the Organization. Cannot be changed later.
     * @param string              $displayName          The displayed name of the Organization.
     * @param array<string,mixed> $branding             An array containing branding customizations for the organization.
     * @param array<string,mixed> $metadata             Optional. Additional metadata to store about the organization.
     * @param array<string,mixed> $additionalParameters Optional. Additional parameters to send with the API request.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function create(
        string $name,
        string $displayName,
        array $branding,
        array $metadata = [],
        array $additionalParameters = []
    )
    {
        $this->validateBranding($branding);

        $payload = [
            'name'         => $name,
            'display_name' => $displayName,
            'branding'     => $branding,
            'metadata'     => $metadata,
        ] + $additionalParameters;

        return $this->apiClient->method('post')
        ->addPath('organizations')
        ->withBody(json_encode($payload))
        ->call();
    }

    /**
     * Update an organization.
     * Required scope: "update:organizations"
     *
     * @param string              $organization         Organization (by ID) to update.
     * @param string              $displayName          The displayed name of the Organization.
     * @param array<string,mixed> $branding             An array containing branding customizations for the organization.
     * @param array<string,mixed> $metadata             Optional. Additional metadata to store about the organization.
     * @param array<string,mixed> $additionalParameters Optional. Additional parameters to send with the API request.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function patch(
        string $organization,
        string $displayName,
        array $branding,
        array $metadata = [],
        array $additionalParameters = []
    )
    {
        $this->validateBranding($branding);

        $payload = [
            'display_name' => $displayName,
            'branding'     => $branding,
            'metadata'     => $metadata,
        ] + $additionalParameters;

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
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function delete(
        string $organization
    )
    {
        return $this->apiClient->method('delete')
        ->addPath('organizations', $organization)
        ->call();
    }

    /**
     * List the connections associated with an organization.
     * Required scope: "read:organization_connections"
     *
     * @param string              $organization Organization (by ID) to list connections of.
     * @param array<string,mixed> $params       Optional. Additional options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function getConnections(
        string $organization,
        array $params = []
    )
    {
        return $this->apiClient->method('get')
        ->addPath('organizations', $organization, 'connections')
        ->withDictParams($this->normalizeRequest($params))
        ->call();
    }

    /**
     * Add a connection to an organization.
     * Required scope: "create:organization_connections"
     *
     * @param string $organization Organization (by ID) to add a connection to.
     * @param string $connection   Connection (by ID) to add to organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addConnection(
        string $organization,
        string $connection
    )
    {
        return $this->apiClient->method('post')
        ->addPath('organizations', $organization, 'connections', $connection)
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
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeConnection(
        string $organization,
        string $connection
    )
    {
        return $this->apiClient->method('delete')
        ->addPath('organizations', $organization, 'connections', $connection)
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
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function getMembers(
        string $organization,
        array $params = []
    )
    {
        return $this->apiClient->method('get')
        ->addPath('organizations', $organization, 'members')
        ->withDictParams($this->normalizeRequest($params))
        ->call();
    }

    /**
     * Add a user to an organization as a member.
     * Required scope: "update:organization_members"
     *
     * @param string $organization Organization (by ID) to add new members to.
     * @param string $user         User (by ID) to add from the organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addMember(
        string $organization,
        string $user
    )
    {
        return $this->addMembers($organization, [ $user ]);
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
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addMembers(
        string $organization,
        array $users
    )
    {
        $payload = [
            'members' => $users
        ];

        return $this->apiClient->method('post')
        ->addPath('organizations', $organization, 'members')
        ->withBody(json_encode($payload))
        ->call();
    }

    /**
     * Remove a member (user) from an organization.
     * Required scope: "delete:organization_members"
     *
     * @param string $organization Organization (by ID) user belongs to.
     * @param string $user         User (by ID) to remove from the organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeMember(
        string $organization,
        string $user
    )
    {
        return $this->removeMembers($organization, [ $user ]);
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
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeMembers(
        string $organization,
        array $users
    )
    {
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
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function getMemberRoles(
        string $organization,
        string $user,
        array $params = []
    )
    {
        return $this->apiClient->method('get')
        ->addPath('organizations', $organization, 'members', $user)
        ->withDictParams($this->normalizeRequest($params))
        ->call();
    }

    /**
     * Add a role to a member (user) in an organization.
     * Required scope: "create:organization_member_roles"
     *
     * @param string $organization Organization (by ID) user belongs to.
     * @param string $user         User (by ID) to add role to.
     * @param string $role         Role (by ID) to add to the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addMemberRole(
        string $organization,
        string $user,
        string $role
    )
    {
        return $this->addMemberRoles($organization, $user, [ $role ]);
    }

    /**
     * Add one or more roles to a member (user) in an organization.
     * Required scope: "create:organization_member_roles"
     *
     * @param string $organization  Organization (by ID) user belongs to.
     * @param string $user          User (by ID) to add roles to.
     * @param array  $roles<string> One or more roles (by ID) to add to the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addMemberRoles(
        string $organization,
        string $user,
        array $roles
    )
    {
        $payload = [
            'roles' => $roles
        ];

        return $this->apiClient->method('post')
        ->addPath('organizations', $organization, 'members', $user)
        ->withBody(json_encode($payload))
        ->call();
    }

    /**
     * Remove a role from a member (user) in an organization.
     * Required scope: "delete:organization_member_roles"
     *
     * @param string $organization Organization (by ID) user belongs to.
     * @param string $user         User (by ID) to remove roles from.
     * @param string $role         Role (by ID) to remove from the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeMemberRole(
        string $organization,
        string $user,
        string $role
    )
    {
        return $this->removeMemberRoles($organization, $user, [ $role ]);
    }

    /**
     * Remove one or more roles from a member (user) in an organization.
     * Required scope: "delete:organization_member_roles"
     *
     * @param string $organization  Organization (by ID) user belongs to.
     * @param string $user          User (by ID) to remove roles from.
     * @param array  $roles<string> One or more roles (by ID) to remove from the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeMemberRoles(
        string $organization,
        string $user,
        array $roles
    )
    {
        $payload = [
            'roles' => $roles
        ];

        return $this->apiClient->method('delete')
        ->addPath('organizations', $organization, 'members', $user)
        ->withBody(json_encode($payload))
        ->call();
    }

    /**
     * Validate an array containing branding customizations for use during the creation or updating of an organization.
     *
     * @param array<string,mixed> $branding An array containing branding customizations for the organization.
     *
     * @return void
     *
     * @throws EmptyOrInvalidParameterException When an improperly formatted branding customization is provided.
     */
    protected function validateBranding(
        array $branding
    )
    {
        // #TODO
        return true;
    }
}
