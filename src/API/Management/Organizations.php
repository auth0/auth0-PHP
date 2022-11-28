<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\OrganizationsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Organizations
 * Handles requests to the Organizations endpoints of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Organizations
 */
final class Organizations extends ManagementEndpoint implements OrganizationsInterface
{
    public function create(
        string $name,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$name, $displayName] = Toolkit::filter([$name, $displayName])->string()->trim();
        [$branding, $metadata, $body] = Toolkit::filter([$branding, $metadata, $body])->array()->trim();
        [$branding, $metadata] = Toolkit::filter([$branding, $metadata])->array()->object();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
            [$displayName, \Auth0\SDK\Exception\ArgumentException::missing('displayName')],
        ])->isString();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('organizations')->
            withBody(
                (object) Toolkit::merge([
                    'name'         => $name,
                    'display_name' => $displayName,
                    'branding'     => $branding,
                    'metadata'     => $metadata,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function getAll(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('organizations')->
            withOptions($options)->
            call();
    }

    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('organizations', $id)->
            withOptions($options)->
            call();
    }

    public function getByName(
        string $name,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$name] = Toolkit::filter([$name])->string()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('organizations', 'name', $name)->
            withOptions($options)->
            call();
    }

    public function update(
        string $id,
        string $name,
        string $displayName,
        ?array $branding = null,
        ?array $metadata = null,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $name, $displayName] = Toolkit::filter([$id, $name, $displayName])->string()->trim();
        [$branding, $metadata, $body] = Toolkit::filter([$branding, $metadata, $body])->array()->trim();
        [$branding, $metadata] = Toolkit::filter([$branding, $metadata])->array()->object();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$displayName, \Auth0\SDK\Exception\ArgumentException::missing('displayName')],
        ])->isString();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('patch')->
            addPath('organizations', $id)->
            withBody(
                (object) Toolkit::merge([
                    'name'         => $name,
                    'display_name' => $displayName,
                    'branding'     => $branding,
                    'metadata'     => $metadata,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('organizations', $id)->
            withOptions($options)->
            call();
    }

    public function addEnabledConnection(
        string $id,
        string $connectionId,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $connectionId] = Toolkit::filter([$id, $connectionId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$connectionId, \Auth0\SDK\Exception\ArgumentException::missing('connectionId')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('organizations', $id, 'enabled_connections')->
            withBody(
                (object) Toolkit::merge([
                    'connection_id' => $connectionId,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function getEnabledConnections(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('organizations', $id, 'enabled_connections')->
            withOptions($options)->
            call();
    }

    public function getEnabledConnection(
        string $id,
        string $connectionId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $connectionId] = Toolkit::filter([$id, $connectionId])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$connectionId, \Auth0\SDK\Exception\ArgumentException::missing('connectionId')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('organizations', $id, 'enabled_connections', $connectionId)->
            withOptions($options)->
            call();
    }

    public function updateEnabledConnection(
        string $id,
        string $connectionId,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $connectionId] = Toolkit::filter([$id, $connectionId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$connectionId, \Auth0\SDK\Exception\ArgumentException::missing('connectionId')],
        ])->isString();

        return $this->getHttpClient()->
            method('patch')->
            addPath('organizations', $id, 'enabled_connections', $connectionId)->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function removeEnabledConnection(
        string $id,
        string $connectionId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $connectionId] = Toolkit::filter([$id, $connectionId])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$connectionId, \Auth0\SDK\Exception\ArgumentException::missing('connectionId')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('organizations', $id, 'enabled_connections', $connectionId)->
            withOptions($options)->
            call();
    }

    public function addMembers(
        string $id,
        array $members,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$members] = Toolkit::filter([$members])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$members, \Auth0\SDK\Exception\ArgumentException::missing('members')],
        ])->isArray();

        return $this->getHttpClient()->
            method('post')->
            addPath('organizations', $id, 'members')->
            withBody(
                (object) [
                    'members' => $members,
                ],
            )->
            withOptions($options)->
            call();
    }

    public function getMembers(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('organizations', $id, 'members')->
            withOptions($options)->
            call();
    }

    public function removeMembers(
        string $id,
        array $members,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$members] = Toolkit::filter([$members])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$members, \Auth0\SDK\Exception\ArgumentException::missing('members')],
        ])->isArray();

        return $this->getHttpClient()->
            method('delete')->
            addPath('organizations', $id, 'members')->
            withBody(
                (object) [
                    'members' => $members,
                ],
            )->
            withOptions($options)->
            call();
    }

    public function addMemberRoles(
        string $id,
        string $userId,
        array $roles,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $userId] = Toolkit::filter([$id, $userId])->string()->trim();
        [$roles] = Toolkit::filter([$roles])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
        ])->isString();

        Toolkit::assert([
            [$roles, \Auth0\SDK\Exception\ArgumentException::missing('roles')],
        ])->isArray();

        return $this->getHttpClient()->
            method('post')->
            addPath('organizations', $id, 'members', $userId, 'roles')->
            withBody(
                (object) [
                    'roles' => $roles,
                ],
            )->
            withOptions($options)->
            call();
    }

    public function getMemberRoles(
        string $id,
        string $userId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $userId] = Toolkit::filter([$id, $userId])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('organizations', $id, 'members', $userId, 'roles')->
            withOptions($options)->
            call();
    }

    public function removeMemberRoles(
        string $id,
        string $userId,
        array $roles,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $userId] = Toolkit::filter([$id, $userId])->string()->trim();
        [$roles] = Toolkit::filter([$roles])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
        ])->isString();

        Toolkit::assert([
            [$roles, \Auth0\SDK\Exception\ArgumentException::missing('roles')],
        ])->isArray();

        return $this->getHttpClient()->
            method('delete')->
            addPath('organizations', $id, 'members', $userId, 'roles')->
            withBody(
                (object) [
                    'roles' => $roles,
                ],
            )->
            withOptions($options)->
            call();
    }

    public function createInvitation(
        string $id,
        string $clientId,
        array $inviter,
        array $invitee,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $clientId] = Toolkit::filter([$id, $clientId])->string()->trim();
        [$inviter, $invitee, $body] = Toolkit::filter([$inviter, $invitee, $body])->array()->trim();

        /* @var array{name?: string} $inviter */
        /* @var array{email?: string} $invitee */

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$clientId, \Auth0\SDK\Exception\ArgumentException::missing('clientId')],
        ])->isString();

        Toolkit::assert([
            [$inviter, \Auth0\SDK\Exception\ArgumentException::missing('inviter')],
            [$invitee, \Auth0\SDK\Exception\ArgumentException::missing('invitee')],
        ])->isArray();

        if (! isset($inviter['name'])) {
            throw \Auth0\SDK\Exception\ArgumentException::missing('inviter.name');
        }

        if (! isset($invitee['email'])) {
            throw \Auth0\SDK\Exception\ArgumentException::missing('invitee.email');
        }

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('organizations', $id, 'invitations')->
            withBody(
                (object) Toolkit::merge([
                    'client_id' => $clientId,
                    'inviter'   => (object) $inviter,
                    'invitee'   => (object) $invitee,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function getInvitations(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('organizations', $id, 'invitations')->
            withOptions($options)->
            call();
    }

    public function getInvitation(
        string $id,
        string $invitationId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $invitationId] = Toolkit::filter([$id, $invitationId])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$invitationId, \Auth0\SDK\Exception\ArgumentException::missing('invitationId')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('organizations', $id, 'invitations', $invitationId)->
            withOptions($options)->
            call();
    }

    public function deleteInvitation(
        string $id,
        string $invitationId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $invitationId] = Toolkit::filter([$id, $invitationId])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$invitationId, \Auth0\SDK\Exception\ArgumentException::missing('invitationId')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('organizations', $id, 'invitations', $invitationId)->
            withOptions($options)->
            call();
    }
}
