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
    ) {
      return $this->apiClient->method('get')
        ->addPath('organizations')
        ->withDictParams($this->normalizeRequest($params))
        ->call();
    }

    /**
     * Get details about an organization, queried by it's ID.
     * Required scope: "read:organizations"
     *
     * @param string $organizationId Organization (by ID) to retrieve details for.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function get(
      string $organizationId
    ) {
      return $this->apiClient->method('get')
        ->addPath('organizations', $organizationId)
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
    ) {
      return $this->apiClient->method('get')
        ->addPath('organizations', 'name', $organizationName)
        ->call();
    }

    /**
     * Create an organization.
     * Required scope: "create:organizations"
     *
     * @param string $name The name of the Organization. Cannot be changed later.
     * @param string $displayName The displayed name of the Organization.
     * @param array<string,mixed> $branding An array containing branding customizations for the organization.
     * @param array<string,mixed> $metadata Optional. Additional metadata to store about the organization.
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
    ) {
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
     * @param string $organizationId Organization (by ID) to update.
     * @param string $displayName The displayed name of the Organization.
     * @param array<string,mixed> $branding An array containing branding customizations for the organization.
     * @param array<string,mixed> $metadata Optional. Additional metadata to store about the organization.
     * @param array<string,mixed> $additionalParameters Optional. Additional parameters to send with the API request.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function patch(
      string $organizationId,
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
        ->addPath('organizations', $organizationId)
        ->withBody(json_encode($payload))
        ->call();
    }

    /**
     * Delete an organization.
     * Required scope: "delete:organizations"
     *
     * @param string $organizationId Organization (by ID) to delete.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function delete(
      string $organizationId
    )
    {
      return $this->apiClient->method('delete')
        ->addPath('organizations', $organizationId)
        ->call();
    }

    /**
     * List the connections associated with an organization.
     * Required scope: "read:organization_connections"
     *
     * @param string $organizationId Organization (by ID) to list connections of.
     * @param array<string,mixed> $params Optional. Additional options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function getConnections(
      string $organizationId,
      array $params = []
    ) {
      return $this->apiClient->method('get')
        ->addPath('organizations', $organizationId, 'connections')
        ->withDictParams($this->normalizeRequest($params))
        ->call();
    }

    /**
     * Add a connection to an organization.
     * Required scope: "create:organization_connections"
     *
     * @param string $organizationId Organization (by ID) to add a connection to.
     * @param string $connectionId Connection (by ID) to add to organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addConnection(
      string $organizationId,
      string $connectionId
    ) {
      return $this->apiClient->method('post')
        ->addPath('organizations', $organizationId, 'connections', $connectionId)
        ->call();
    }

    /**
     * Remove a connection from an organization.
     * Required scope: "delete:organization_connections"
     *
     * @param string $organizationId Organization (by ID) to remove connection from.
     * @param string $connectionId Connection (by ID) to remove from organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeConnection(
      string $organizationId,
      string $connectionId
    ) {
      return $this->apiClient->method('delete')
        ->addPath('organizations', $organizationId, 'connections', $connectionId)
        ->call();
    }

    /**
     * List the members (users) belonging to an organization
     * Required scope: "read:organization_members"
     *
     * @param string $organizationId Organization (by ID) to list members of.
     * @param array<string,mixed> $params Optional. Additional options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function getMembers(
      string $organizationId,
      array $params = []
    ) {
      return $this->apiClient->method('get')
        ->addPath('organizations', $organizationId, 'members')
        ->withDictParams($this->normalizeRequest($params))
        ->call();
    }

    /**
     * Add a user to an organization as a member.
     * Required scope: "update:organization_members"
     *
     * @param string $organizationId Organization (by ID) to add new members to.
     * @param string $userId User (by ID) to add from the organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addMember(
      string $organizationId,
      string $userId
    ) {
      return $this->addMembers($organizationId, [ $userId ]);
    }

    /**
     * Add one or more users to an organization as members.
     * Required scope: "update:organization_members"
     *
     * @param string $organizationId Organization (by ID) to add new members to.
     * @param array $userIds One or more users (by ID) to add from the organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addMembers(
      string $organizationId,
      array $userIds
    ) {
      $payload = [
        'members' => $userIds
      ];

      return $this->apiClient->method('post')
        ->addPath('organizations', $organizationId, 'members')
        ->withBody(json_encode($payload))
        ->call();
    }

    /**
     * Remove a member (user) from an organization.
     * Required scope: "delete:organization_members"
     *
     * @param string $organizationId Organization (by ID) user belongs to.
     * @param string $userId User (by ID) to remove from the organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeMember(
      string $organizationId,
      string $userId
    ) {
      return $this->removeMembers($organizationId, [ $userId ]);
    }

    /**
     * Remove one or more members (users) from an organization.
     * Required scope: "delete:organization_members"
     *
     * @param string $organizationId Organization (by ID) users belong to.
     * @param array $userIds One or more users (by ID) to remove from the organization.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeMembers(
      string $organizationId,
      array $userIds
    ) {
      $payload = [
        'members' => $userIds
      ];

      return $this->apiClient->method('delete')
        ->addPath('organizations', $organizationId, 'members')
        ->withBody(json_encode($payload))
        ->call();
    }

    /**
     * List the roles a member (user) in an organization currently has.
     * Required scope: "read:organization_member_roles"
     *
     * @param string $organizationId Organization (by ID) user belongs to.
     * @param string $userId User (by ID) to add role to.
     * @param array<string,mixed> $params Optional. Additional options to include with the request, such as pagination or filtering parameters.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function getMemberRoles(
      string $organizationId,
      string $userId,
      array $params = []
    ) {
      return $this->apiClient->method('get')
        ->addPath('organizations', $organizationId, 'members', $userId)
        ->withDictParams($this->normalizeRequest($params))
        ->call();
    }

    /**
     * Add a role to a member (user) in an organization.
     * Required scope: "create:organization_member_roles"
     *
     * @param string $organizationId Organization (by ID) user belongs to.
     * @param string $userId User (by ID) to add role to.
     * @param string $roleId Role (by ID) to add to the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addMemberRole(
      string $organizationId,
      string $userId,
      string $roleId
    ) {
      return $this->addMemberRoles($organizationId, $userId, [ $roleId ]);
    }

    /**
     * Add one or more roles to a member (user) in an organization.
     * Required scope: "create:organization_member_roles"
     *
     * @param string $organizationId Organization (by ID) user belongs to.
     * @param string $userId User (by ID) to add roles to.
     * @param array $roleIds<string> One or more roles (by ID) to add to the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function addMemberRoles(
      string $organizationId,
      string $userId,
      array $roleIds
    ) {
      $payload = [
        'roles' => $roleIds
      ];

      return $this->apiClient->method('post')
        ->addPath('organizations', $organizationId, 'members', $userId)
        ->withBody(json_encode($payload))
        ->call();
    }

    /**
     * Remove a role from a member (user) in an organization.
     * Required scope: "delete:organization_member_roles"
     *
     * @param string $organizationId Organization (by ID) user belongs to.
     * @param string $userId User (by ID) to remove roles from.
     * @param string $roleId Role (by ID) to remove from the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeMemberRole(
      string $organizationId,
      string $userId,
      string $roleId
    ) {
      return $this->removeMemberRoles($organizationId, $userId, [ $roleId ]);
    }

    /**
     * Remove one or more roles from a member (user) in an organization.
     * Required scope: "delete:organization_member_roles"
     *
     * @param string $organizationId Organization (by ID) user belongs to.
     * @param string $userId User (by ID) to remove roles from.
     * @param array $roleIds<string> One or more roles (by ID) to remove from the user.
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Organizations/ #TODO
     */
    public function removeMemberRoles(
      string $organizationId,
      string $userId,
      array $roleIds
    ) {
      $payload = [
        'roles' => $roleIds
      ];

      return $this->apiClient->method('delete')
        ->addPath('organizations', $organizationId, 'members', $userId)
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
    ) {
      // TODO
      return true;
    }
}
