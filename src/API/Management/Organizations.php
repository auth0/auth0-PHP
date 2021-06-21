<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Shortcut;
use Auth0\SDK\Utility\Validate;
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
     * @param array<mixed>|null   $branding    Optional. An array containing branding customizations for the organization.
     * @param array<mixed>|null   $metadata    Optional. Additional metadata to store about the organization.
     * @param array<mixed>|null   $body        Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function create(
        string $name,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        Validate::string($name, 'name');
        Validate::string($displayName, 'displayName');

        $body = Shortcut::mergeArrays([
            'name' => $name,
            'display_name' => $displayName,
            'branding' => Shortcut::nullifyEmptyArrayAsObject($branding),
            'metadata' => Shortcut::nullifyEmptyArrayAsObject($metadata),
        ], $body);

        return $this->getHttpClient()->method('post')
            ->addPath('organizations')
            ->withBody((object) $body)
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
        return $this->getHttpClient()->method('get')
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
        Validate::string($id, 'id');

        return $this->getHttpClient()->method('get')
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
        Validate::string($name, 'name');

        return $this->getHttpClient()->method('get')
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
     * @param array<mixed>|null    $branding    Optional. An array containing branding customizations for the organization.
     * @param array<mixed>|null    $metadata    Optional. Additional metadata to store about the organization.
     * @param array<mixed>|null    $body        Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null  $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function update(
        string $id,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        Validate::string($id, 'id');
        Validate::string($displayName, 'displayName');

        $body = Shortcut::mergeArrays([
            'display_name' => $displayName,
            'branding' => Shortcut::nullifyEmptyArrayAsObject($branding),
            'metadata' => Shortcut::nullifyEmptyArrayAsObject($metadata),
        ], $body);

        return $this->getHttpClient()->method('patch')
            ->addPath('organizations', $id)
            ->withBody((object) $body)
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
        Validate::string($id, 'id');

        return $this->getHttpClient()->method('delete')
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
     * @param array<mixed>        $body         Additional body content to send with the API request. See @link for supported options.
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
        Validate::string($id, 'id');
        Validate::string($connectionId, 'connectionId');

        $body = Shortcut::mergeArrays([
            'connection_id' => $connectionId,
        ], $body);

        return $this->getHttpClient()->method('post')
            ->addPath('organizations', $id, 'enabled_connections')
            ->withBody((object) $body)
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
        Validate::string($id, 'id');

        return $this->getHttpClient()->method('get')
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
        Validate::string($id, 'id');
        Validate::string($connectionId, 'connectionId');

        return $this->getHttpClient()->method('get')
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
     * @param array<mixed>        $body         Additional body content to pass with the API request. See @link for supported options.
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
        Validate::string($id, 'id');
        Validate::string($connectionId, 'connectionId');

        return $this->getHttpClient()->method('patch')
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
        Validate::string($id, 'id');
        Validate::string($connectionId, 'connectionId');

        return $this->getHttpClient()->method('delete')
            ->addPath('organizations', $id, 'enabled_connections', $connectionId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Add one or more users to an organization as members.
     * Required scope: `update:organization_members`
     *
     * @param string              $id      Organization (by ID) to add new members to.
     * @param array<string>       $members One or more users (by ID) to add from the organization.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function addMembers(
        string $id,
        array $members,
        ?RequestOptions $options = null
    ): ResponseInterface {
        Validate::string($id, 'id');
        Validate::array($members, 'members');

        $payload = [
            'members' => $members,
        ];

        return $this->getHttpClient()->method('post')
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
        Validate::string($id, 'id');

        return $this->getHttpClient()->method('get')
            ->addPath('organizations', $id, 'members')
            ->withOptions($options)
            ->call();
    }

    /**
     * Remove one or more members (users) from an organization.
     * Required scope: `delete:organization_members`
     *
     * @param string              $id      Organization (by ID) users belong to.
     * @param array<string>       $members One or more users (by ID) to remove from the organization.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function removeMembers(
        string $id,
        array $members,
        ?RequestOptions $options = null
    ): ResponseInterface {
        Validate::string($id, 'id');
        Validate::array($members, 'members');

        $payload = [
            'members' => $members,
        ];

        return $this->getHttpClient()->method('delete')
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
        Validate::string($id, 'id');
        Validate::string($userId, 'userId');
        Validate::array($roles, 'roles');

        $payload = [
            'roles' => $roles,
        ];

        return $this->getHttpClient()->method('post')
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
        Validate::string($id, 'id');
        Validate::string($userId, 'userId');

        return $this->getHttpClient()->method('get')
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
        Validate::string($id, 'id');
        Validate::string($userId, 'userId');
        Validate::array($roles, 'roles');

        $payload = [
            'roles' => $roles,
        ];

        return $this->getHttpClient()->method('delete')
            ->addPath('organizations', $id, 'members', $userId, 'roles')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create an invitation for an organization
     * Required scope: `create:organization_invitations`
     *
     * @param string        $id       Organization (by ID) to create the invitation for.
     * @param string        $clientId Client (by ID) to create the invitation for. This Client must be associated with the Organization.
     * @param array<string> $inviter  An array containing information about the inviter. Requires a 'name' key minimally.
     *                                - 'name' Required. A name to identify who is sending the invitation.
     * @param array<string> $invitee  An array containing information about the invitee. Requires an 'email' key.
     *                                - 'email' Required. An email address where the invitation should be sent.
     * @param array<mixed>|null       $body     Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null     $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function createInvitation(
        string $id,
        string $clientId,
        array $inviter,
        array $invitee,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        Validate::string($id, 'id');
        Validate::string($clientId, 'clientId');
        Validate::array($inviter, 'inviter');
        Validate::array($invitee, 'invitee');

        if (! isset($inviter['name'])) {
            throw \Auth0\SDK\Exception\ArgumentException::missing('inviter.name');
        }

        if (! isset($invitee['email'])) {
            throw \Auth0\SDK\Exception\ArgumentException::missing('invitee.email');
        }

        $body = Shortcut::mergeArrays([
            'client_id' => $clientId,
            'inviter' => (object) $inviter,
            'invitee' => (object) $invitee,
        ], $body);

        return $this->getHttpClient()->method('post')
            ->addPath('organizations', $id, 'invitations')
            ->withBody((object) $body)
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
        Validate::string($id, 'id');

        return $this->getHttpClient()->method('get')
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
        Validate::string($id, 'id');
        Validate::string($invitationId, 'invitationId');

        return $this->getHttpClient()->method('get')
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
        Validate::string($id, 'id');
        Validate::string($invitationId, 'invitation');

        return $this->getHttpClient()->method('delete')
            ->addPath('organizations', $id, 'invitations', $invitationId)
            ->withOptions($options)
            ->call();
    }
}
