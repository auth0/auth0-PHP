<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Exception;

/**
 * The JSON payload delivered in each SSE data line. The type field is injected from the SSE event field by the SDK. Discriminated by type: an event type name for events, "error" for errors, and "offset-only" for cursor-only heartbeats.
 */
class EventStreamSubscribeEventsResponseContent extends JsonSerializableType
{
    /**
     * @var (
     *    'group.created'
     *   |'group.deleted'
     *   |'group.member.added'
     *   |'group.member.deleted'
     *   |'group.role.assigned'
     *   |'group.role.deleted'
     *   |'group.updated'
     *   |'organization.connection.added'
     *   |'organization.connection.removed'
     *   |'organization.connection.updated'
     *   |'organization.created'
     *   |'organization.deleted'
     *   |'organization.group.role.assigned'
     *   |'organization.group.role.deleted'
     *   |'organization.member.added'
     *   |'organization.member.deleted'
     *   |'organization.member.role.assigned'
     *   |'organization.member.role.deleted'
     *   |'organization.updated'
     *   |'user.created'
     *   |'user.deleted'
     *   |'user.updated'
     *   |'error'
     *   |'offset-only'
     *   |'_unknown'
     * ) $type
     */
    private readonly string $type;

    /**
     * @var (
     *    EventStreamCloudEventGroupCreated
     *   |EventStreamCloudEventGroupDeleted
     *   |EventStreamCloudEventGroupMemberAdded
     *   |EventStreamCloudEventGroupMemberDeleted
     *   |EventStreamCloudEventGroupRoleAssigned
     *   |EventStreamCloudEventGroupRoleDeleted
     *   |EventStreamCloudEventGroupUpdated
     *   |EventStreamCloudEventOrgConnectionAdded
     *   |EventStreamCloudEventOrgConnectionRemoved
     *   |EventStreamCloudEventOrgConnectionUpdated
     *   |EventStreamCloudEventOrgCreated
     *   |EventStreamCloudEventOrgDeleted
     *   |EventStreamCloudEventOrgGroupRoleAssigned
     *   |EventStreamCloudEventOrgGroupRoleDeleted
     *   |EventStreamCloudEventOrgMemberAdded
     *   |EventStreamCloudEventOrgMemberDeleted
     *   |EventStreamCloudEventOrgMemberRoleAssigned
     *   |EventStreamCloudEventOrgMemberRoleDeleted
     *   |EventStreamCloudEventOrgUpdated
     *   |EventStreamCloudEventUserCreated
     *   |EventStreamCloudEventUserDeleted
     *   |EventStreamCloudEventUserUpdated
     *   |EventStreamCloudEventErrorMessage
     *   |EventStreamCloudEventOffsetOnlyMessage
     *   |mixed
     * ) $value
     */
    private readonly mixed $value;

    /**
     * @param array{
     *   type: (
     *    'group.created'
     *   |'group.deleted'
     *   |'group.member.added'
     *   |'group.member.deleted'
     *   |'group.role.assigned'
     *   |'group.role.deleted'
     *   |'group.updated'
     *   |'organization.connection.added'
     *   |'organization.connection.removed'
     *   |'organization.connection.updated'
     *   |'organization.created'
     *   |'organization.deleted'
     *   |'organization.group.role.assigned'
     *   |'organization.group.role.deleted'
     *   |'organization.member.added'
     *   |'organization.member.deleted'
     *   |'organization.member.role.assigned'
     *   |'organization.member.role.deleted'
     *   |'organization.updated'
     *   |'user.created'
     *   |'user.deleted'
     *   |'user.updated'
     *   |'error'
     *   |'offset-only'
     *   |'_unknown'
     * ),
     *   value: (
     *    EventStreamCloudEventGroupCreated
     *   |EventStreamCloudEventGroupDeleted
     *   |EventStreamCloudEventGroupMemberAdded
     *   |EventStreamCloudEventGroupMemberDeleted
     *   |EventStreamCloudEventGroupRoleAssigned
     *   |EventStreamCloudEventGroupRoleDeleted
     *   |EventStreamCloudEventGroupUpdated
     *   |EventStreamCloudEventOrgConnectionAdded
     *   |EventStreamCloudEventOrgConnectionRemoved
     *   |EventStreamCloudEventOrgConnectionUpdated
     *   |EventStreamCloudEventOrgCreated
     *   |EventStreamCloudEventOrgDeleted
     *   |EventStreamCloudEventOrgGroupRoleAssigned
     *   |EventStreamCloudEventOrgGroupRoleDeleted
     *   |EventStreamCloudEventOrgMemberAdded
     *   |EventStreamCloudEventOrgMemberDeleted
     *   |EventStreamCloudEventOrgMemberRoleAssigned
     *   |EventStreamCloudEventOrgMemberRoleDeleted
     *   |EventStreamCloudEventOrgUpdated
     *   |EventStreamCloudEventUserCreated
     *   |EventStreamCloudEventUserDeleted
     *   |EventStreamCloudEventUserUpdated
     *   |EventStreamCloudEventErrorMessage
     *   |EventStreamCloudEventOffsetOnlyMessage
     *   |mixed
     * ),
     * } $values
     */
    private function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->value = $values['value'];
    }

    /**
     * @return (
     *    'group.created'
     *   |'group.deleted'
     *   |'group.member.added'
     *   |'group.member.deleted'
     *   |'group.role.assigned'
     *   |'group.role.deleted'
     *   |'group.updated'
     *   |'organization.connection.added'
     *   |'organization.connection.removed'
     *   |'organization.connection.updated'
     *   |'organization.created'
     *   |'organization.deleted'
     *   |'organization.group.role.assigned'
     *   |'organization.group.role.deleted'
     *   |'organization.member.added'
     *   |'organization.member.deleted'
     *   |'organization.member.role.assigned'
     *   |'organization.member.role.deleted'
     *   |'organization.updated'
     *   |'user.created'
     *   |'user.deleted'
     *   |'user.updated'
     *   |'error'
     *   |'offset-only'
     *   |'_unknown'
     * )
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return (
     *    EventStreamCloudEventGroupCreated
     *   |EventStreamCloudEventGroupDeleted
     *   |EventStreamCloudEventGroupMemberAdded
     *   |EventStreamCloudEventGroupMemberDeleted
     *   |EventStreamCloudEventGroupRoleAssigned
     *   |EventStreamCloudEventGroupRoleDeleted
     *   |EventStreamCloudEventGroupUpdated
     *   |EventStreamCloudEventOrgConnectionAdded
     *   |EventStreamCloudEventOrgConnectionRemoved
     *   |EventStreamCloudEventOrgConnectionUpdated
     *   |EventStreamCloudEventOrgCreated
     *   |EventStreamCloudEventOrgDeleted
     *   |EventStreamCloudEventOrgGroupRoleAssigned
     *   |EventStreamCloudEventOrgGroupRoleDeleted
     *   |EventStreamCloudEventOrgMemberAdded
     *   |EventStreamCloudEventOrgMemberDeleted
     *   |EventStreamCloudEventOrgMemberRoleAssigned
     *   |EventStreamCloudEventOrgMemberRoleDeleted
     *   |EventStreamCloudEventOrgUpdated
     *   |EventStreamCloudEventUserCreated
     *   |EventStreamCloudEventUserDeleted
     *   |EventStreamCloudEventUserUpdated
     *   |EventStreamCloudEventErrorMessage
     *   |EventStreamCloudEventOffsetOnlyMessage
     *   |mixed
     * )
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @param EventStreamCloudEventGroupCreated $groupCreated
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function groupCreated(EventStreamCloudEventGroupCreated $groupCreated): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'group.created',
            'value' => $groupCreated,
        ]);
    }

    /**
     * @param EventStreamCloudEventGroupDeleted $groupDeleted
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function groupDeleted(EventStreamCloudEventGroupDeleted $groupDeleted): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'group.deleted',
            'value' => $groupDeleted,
        ]);
    }

    /**
     * @param EventStreamCloudEventGroupMemberAdded $groupMemberAdded
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function groupMemberAdded(EventStreamCloudEventGroupMemberAdded $groupMemberAdded): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'group.member.added',
            'value' => $groupMemberAdded,
        ]);
    }

    /**
     * @param EventStreamCloudEventGroupMemberDeleted $groupMemberDeleted
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function groupMemberDeleted(EventStreamCloudEventGroupMemberDeleted $groupMemberDeleted): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'group.member.deleted',
            'value' => $groupMemberDeleted,
        ]);
    }

    /**
     * @param EventStreamCloudEventGroupRoleAssigned $groupRoleAssigned
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function groupRoleAssigned(EventStreamCloudEventGroupRoleAssigned $groupRoleAssigned): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'group.role.assigned',
            'value' => $groupRoleAssigned,
        ]);
    }

    /**
     * @param EventStreamCloudEventGroupRoleDeleted $groupRoleDeleted
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function groupRoleDeleted(EventStreamCloudEventGroupRoleDeleted $groupRoleDeleted): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'group.role.deleted',
            'value' => $groupRoleDeleted,
        ]);
    }

    /**
     * @param EventStreamCloudEventGroupUpdated $groupUpdated
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function groupUpdated(EventStreamCloudEventGroupUpdated $groupUpdated): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'group.updated',
            'value' => $groupUpdated,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgConnectionAdded $organizationConnectionAdded
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationConnectionAdded(EventStreamCloudEventOrgConnectionAdded $organizationConnectionAdded): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.connection.added',
            'value' => $organizationConnectionAdded,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgConnectionRemoved $organizationConnectionRemoved
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationConnectionRemoved(EventStreamCloudEventOrgConnectionRemoved $organizationConnectionRemoved): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.connection.removed',
            'value' => $organizationConnectionRemoved,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgConnectionUpdated $organizationConnectionUpdated
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationConnectionUpdated(EventStreamCloudEventOrgConnectionUpdated $organizationConnectionUpdated): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.connection.updated',
            'value' => $organizationConnectionUpdated,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgCreated $organizationCreated
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationCreated(EventStreamCloudEventOrgCreated $organizationCreated): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.created',
            'value' => $organizationCreated,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgDeleted $organizationDeleted
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationDeleted(EventStreamCloudEventOrgDeleted $organizationDeleted): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.deleted',
            'value' => $organizationDeleted,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleAssigned $organizationGroupRoleAssigned
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationGroupRoleAssigned(EventStreamCloudEventOrgGroupRoleAssigned $organizationGroupRoleAssigned): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.group.role.assigned',
            'value' => $organizationGroupRoleAssigned,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleDeleted $organizationGroupRoleDeleted
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationGroupRoleDeleted(EventStreamCloudEventOrgGroupRoleDeleted $organizationGroupRoleDeleted): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.group.role.deleted',
            'value' => $organizationGroupRoleDeleted,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgMemberAdded $organizationMemberAdded
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationMemberAdded(EventStreamCloudEventOrgMemberAdded $organizationMemberAdded): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.member.added',
            'value' => $organizationMemberAdded,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgMemberDeleted $organizationMemberDeleted
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationMemberDeleted(EventStreamCloudEventOrgMemberDeleted $organizationMemberDeleted): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.member.deleted',
            'value' => $organizationMemberDeleted,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleAssigned $organizationMemberRoleAssigned
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationMemberRoleAssigned(EventStreamCloudEventOrgMemberRoleAssigned $organizationMemberRoleAssigned): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.member.role.assigned',
            'value' => $organizationMemberRoleAssigned,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleDeleted $organizationMemberRoleDeleted
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationMemberRoleDeleted(EventStreamCloudEventOrgMemberRoleDeleted $organizationMemberRoleDeleted): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.member.role.deleted',
            'value' => $organizationMemberRoleDeleted,
        ]);
    }

    /**
     * @param EventStreamCloudEventOrgUpdated $organizationUpdated
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function organizationUpdated(EventStreamCloudEventOrgUpdated $organizationUpdated): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'organization.updated',
            'value' => $organizationUpdated,
        ]);
    }

    /**
     * @param EventStreamCloudEventUserCreated $userCreated
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function userCreated(EventStreamCloudEventUserCreated $userCreated): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'user.created',
            'value' => $userCreated,
        ]);
    }

    /**
     * @param EventStreamCloudEventUserDeleted $userDeleted
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function userDeleted(EventStreamCloudEventUserDeleted $userDeleted): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'user.deleted',
            'value' => $userDeleted,
        ]);
    }

    /**
     * @param EventStreamCloudEventUserUpdated $userUpdated
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function userUpdated(EventStreamCloudEventUserUpdated $userUpdated): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'user.updated',
            'value' => $userUpdated,
        ]);
    }

    /**
     * @param EventStreamCloudEventErrorMessage $error
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function error(EventStreamCloudEventErrorMessage $error): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'error',
            'value' => $error,
        ]);
    }

    /**
     * @param EventStreamCloudEventOffsetOnlyMessage $offsetOnly
     * @return EventStreamSubscribeEventsResponseContent
     */
    public static function offsetOnly(EventStreamCloudEventOffsetOnlyMessage $offsetOnly): EventStreamSubscribeEventsResponseContent
    {
        return new EventStreamSubscribeEventsResponseContent([
            'type' => 'offset-only',
            'value' => $offsetOnly,
        ]);
    }

    /**
     * @return bool
     */
    public function isGroupCreated(): bool
    {
        return $this->value instanceof EventStreamCloudEventGroupCreated && $this->type === 'group.created';
    }

    /**
     * @return EventStreamCloudEventGroupCreated
     */
    public function asGroupCreated(): EventStreamCloudEventGroupCreated
    {
        if (!($this->value instanceof EventStreamCloudEventGroupCreated && $this->type === 'group.created')) {
            throw new Exception(
                "Expected group.created; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isGroupDeleted(): bool
    {
        return $this->value instanceof EventStreamCloudEventGroupDeleted && $this->type === 'group.deleted';
    }

    /**
     * @return EventStreamCloudEventGroupDeleted
     */
    public function asGroupDeleted(): EventStreamCloudEventGroupDeleted
    {
        if (!($this->value instanceof EventStreamCloudEventGroupDeleted && $this->type === 'group.deleted')) {
            throw new Exception(
                "Expected group.deleted; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isGroupMemberAdded(): bool
    {
        return $this->value instanceof EventStreamCloudEventGroupMemberAdded && $this->type === 'group.member.added';
    }

    /**
     * @return EventStreamCloudEventGroupMemberAdded
     */
    public function asGroupMemberAdded(): EventStreamCloudEventGroupMemberAdded
    {
        if (!($this->value instanceof EventStreamCloudEventGroupMemberAdded && $this->type === 'group.member.added')) {
            throw new Exception(
                "Expected group.member.added; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isGroupMemberDeleted(): bool
    {
        return $this->value instanceof EventStreamCloudEventGroupMemberDeleted && $this->type === 'group.member.deleted';
    }

    /**
     * @return EventStreamCloudEventGroupMemberDeleted
     */
    public function asGroupMemberDeleted(): EventStreamCloudEventGroupMemberDeleted
    {
        if (!($this->value instanceof EventStreamCloudEventGroupMemberDeleted && $this->type === 'group.member.deleted')) {
            throw new Exception(
                "Expected group.member.deleted; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isGroupRoleAssigned(): bool
    {
        return $this->value instanceof EventStreamCloudEventGroupRoleAssigned && $this->type === 'group.role.assigned';
    }

    /**
     * @return EventStreamCloudEventGroupRoleAssigned
     */
    public function asGroupRoleAssigned(): EventStreamCloudEventGroupRoleAssigned
    {
        if (!($this->value instanceof EventStreamCloudEventGroupRoleAssigned && $this->type === 'group.role.assigned')) {
            throw new Exception(
                "Expected group.role.assigned; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isGroupRoleDeleted(): bool
    {
        return $this->value instanceof EventStreamCloudEventGroupRoleDeleted && $this->type === 'group.role.deleted';
    }

    /**
     * @return EventStreamCloudEventGroupRoleDeleted
     */
    public function asGroupRoleDeleted(): EventStreamCloudEventGroupRoleDeleted
    {
        if (!($this->value instanceof EventStreamCloudEventGroupRoleDeleted && $this->type === 'group.role.deleted')) {
            throw new Exception(
                "Expected group.role.deleted; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isGroupUpdated(): bool
    {
        return $this->value instanceof EventStreamCloudEventGroupUpdated && $this->type === 'group.updated';
    }

    /**
     * @return EventStreamCloudEventGroupUpdated
     */
    public function asGroupUpdated(): EventStreamCloudEventGroupUpdated
    {
        if (!($this->value instanceof EventStreamCloudEventGroupUpdated && $this->type === 'group.updated')) {
            throw new Exception(
                "Expected group.updated; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationConnectionAdded(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgConnectionAdded && $this->type === 'organization.connection.added';
    }

    /**
     * @return EventStreamCloudEventOrgConnectionAdded
     */
    public function asOrganizationConnectionAdded(): EventStreamCloudEventOrgConnectionAdded
    {
        if (!($this->value instanceof EventStreamCloudEventOrgConnectionAdded && $this->type === 'organization.connection.added')) {
            throw new Exception(
                "Expected organization.connection.added; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationConnectionRemoved(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgConnectionRemoved && $this->type === 'organization.connection.removed';
    }

    /**
     * @return EventStreamCloudEventOrgConnectionRemoved
     */
    public function asOrganizationConnectionRemoved(): EventStreamCloudEventOrgConnectionRemoved
    {
        if (!($this->value instanceof EventStreamCloudEventOrgConnectionRemoved && $this->type === 'organization.connection.removed')) {
            throw new Exception(
                "Expected organization.connection.removed; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationConnectionUpdated(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgConnectionUpdated && $this->type === 'organization.connection.updated';
    }

    /**
     * @return EventStreamCloudEventOrgConnectionUpdated
     */
    public function asOrganizationConnectionUpdated(): EventStreamCloudEventOrgConnectionUpdated
    {
        if (!($this->value instanceof EventStreamCloudEventOrgConnectionUpdated && $this->type === 'organization.connection.updated')) {
            throw new Exception(
                "Expected organization.connection.updated; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationCreated(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgCreated && $this->type === 'organization.created';
    }

    /**
     * @return EventStreamCloudEventOrgCreated
     */
    public function asOrganizationCreated(): EventStreamCloudEventOrgCreated
    {
        if (!($this->value instanceof EventStreamCloudEventOrgCreated && $this->type === 'organization.created')) {
            throw new Exception(
                "Expected organization.created; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationDeleted(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgDeleted && $this->type === 'organization.deleted';
    }

    /**
     * @return EventStreamCloudEventOrgDeleted
     */
    public function asOrganizationDeleted(): EventStreamCloudEventOrgDeleted
    {
        if (!($this->value instanceof EventStreamCloudEventOrgDeleted && $this->type === 'organization.deleted')) {
            throw new Exception(
                "Expected organization.deleted; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationGroupRoleAssigned(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgGroupRoleAssigned && $this->type === 'organization.group.role.assigned';
    }

    /**
     * @return EventStreamCloudEventOrgGroupRoleAssigned
     */
    public function asOrganizationGroupRoleAssigned(): EventStreamCloudEventOrgGroupRoleAssigned
    {
        if (!($this->value instanceof EventStreamCloudEventOrgGroupRoleAssigned && $this->type === 'organization.group.role.assigned')) {
            throw new Exception(
                "Expected organization.group.role.assigned; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationGroupRoleDeleted(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgGroupRoleDeleted && $this->type === 'organization.group.role.deleted';
    }

    /**
     * @return EventStreamCloudEventOrgGroupRoleDeleted
     */
    public function asOrganizationGroupRoleDeleted(): EventStreamCloudEventOrgGroupRoleDeleted
    {
        if (!($this->value instanceof EventStreamCloudEventOrgGroupRoleDeleted && $this->type === 'organization.group.role.deleted')) {
            throw new Exception(
                "Expected organization.group.role.deleted; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationMemberAdded(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgMemberAdded && $this->type === 'organization.member.added';
    }

    /**
     * @return EventStreamCloudEventOrgMemberAdded
     */
    public function asOrganizationMemberAdded(): EventStreamCloudEventOrgMemberAdded
    {
        if (!($this->value instanceof EventStreamCloudEventOrgMemberAdded && $this->type === 'organization.member.added')) {
            throw new Exception(
                "Expected organization.member.added; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationMemberDeleted(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgMemberDeleted && $this->type === 'organization.member.deleted';
    }

    /**
     * @return EventStreamCloudEventOrgMemberDeleted
     */
    public function asOrganizationMemberDeleted(): EventStreamCloudEventOrgMemberDeleted
    {
        if (!($this->value instanceof EventStreamCloudEventOrgMemberDeleted && $this->type === 'organization.member.deleted')) {
            throw new Exception(
                "Expected organization.member.deleted; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationMemberRoleAssigned(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgMemberRoleAssigned && $this->type === 'organization.member.role.assigned';
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleAssigned
     */
    public function asOrganizationMemberRoleAssigned(): EventStreamCloudEventOrgMemberRoleAssigned
    {
        if (!($this->value instanceof EventStreamCloudEventOrgMemberRoleAssigned && $this->type === 'organization.member.role.assigned')) {
            throw new Exception(
                "Expected organization.member.role.assigned; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationMemberRoleDeleted(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgMemberRoleDeleted && $this->type === 'organization.member.role.deleted';
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleDeleted
     */
    public function asOrganizationMemberRoleDeleted(): EventStreamCloudEventOrgMemberRoleDeleted
    {
        if (!($this->value instanceof EventStreamCloudEventOrgMemberRoleDeleted && $this->type === 'organization.member.role.deleted')) {
            throw new Exception(
                "Expected organization.member.role.deleted; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOrganizationUpdated(): bool
    {
        return $this->value instanceof EventStreamCloudEventOrgUpdated && $this->type === 'organization.updated';
    }

    /**
     * @return EventStreamCloudEventOrgUpdated
     */
    public function asOrganizationUpdated(): EventStreamCloudEventOrgUpdated
    {
        if (!($this->value instanceof EventStreamCloudEventOrgUpdated && $this->type === 'organization.updated')) {
            throw new Exception(
                "Expected organization.updated; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isUserCreated(): bool
    {
        return $this->value instanceof EventStreamCloudEventUserCreated && $this->type === 'user.created';
    }

    /**
     * @return EventStreamCloudEventUserCreated
     */
    public function asUserCreated(): EventStreamCloudEventUserCreated
    {
        if (!($this->value instanceof EventStreamCloudEventUserCreated && $this->type === 'user.created')) {
            throw new Exception(
                "Expected user.created; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isUserDeleted(): bool
    {
        return $this->value instanceof EventStreamCloudEventUserDeleted && $this->type === 'user.deleted';
    }

    /**
     * @return EventStreamCloudEventUserDeleted
     */
    public function asUserDeleted(): EventStreamCloudEventUserDeleted
    {
        if (!($this->value instanceof EventStreamCloudEventUserDeleted && $this->type === 'user.deleted')) {
            throw new Exception(
                "Expected user.deleted; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isUserUpdated(): bool
    {
        return $this->value instanceof EventStreamCloudEventUserUpdated && $this->type === 'user.updated';
    }

    /**
     * @return EventStreamCloudEventUserUpdated
     */
    public function asUserUpdated(): EventStreamCloudEventUserUpdated
    {
        if (!($this->value instanceof EventStreamCloudEventUserUpdated && $this->type === 'user.updated')) {
            throw new Exception(
                "Expected user.updated; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->value instanceof EventStreamCloudEventErrorMessage && $this->type === 'error';
    }

    /**
     * @return EventStreamCloudEventErrorMessage
     */
    public function asError(): EventStreamCloudEventErrorMessage
    {
        if (!($this->value instanceof EventStreamCloudEventErrorMessage && $this->type === 'error')) {
            throw new Exception(
                "Expected error; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOffsetOnly(): bool
    {
        return $this->value instanceof EventStreamCloudEventOffsetOnlyMessage && $this->type === 'offset-only';
    }

    /**
     * @return EventStreamCloudEventOffsetOnlyMessage
     */
    public function asOffsetOnly(): EventStreamCloudEventOffsetOnlyMessage
    {
        if (!($this->value instanceof EventStreamCloudEventOffsetOnlyMessage && $this->type === 'offset-only')) {
            throw new Exception(
                "Expected offset-only; got " . $this->type . " with value of type " . get_debug_type($this->value),
            );
        }

        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        $result = [];
        $result['type'] = $this->type;

        $base = parent::jsonSerialize();
        $result = array_merge($base, $result);

        switch ($this->type) {
            case 'group.created':
                $value = $this->asGroupCreated()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'group.deleted':
                $value = $this->asGroupDeleted()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'group.member.added':
                $value = $this->asGroupMemberAdded()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'group.member.deleted':
                $value = $this->asGroupMemberDeleted()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'group.role.assigned':
                $value = $this->asGroupRoleAssigned()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'group.role.deleted':
                $value = $this->asGroupRoleDeleted()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'group.updated':
                $value = $this->asGroupUpdated()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.connection.added':
                $value = $this->asOrganizationConnectionAdded()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.connection.removed':
                $value = $this->asOrganizationConnectionRemoved()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.connection.updated':
                $value = $this->asOrganizationConnectionUpdated()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.created':
                $value = $this->asOrganizationCreated()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.deleted':
                $value = $this->asOrganizationDeleted()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.group.role.assigned':
                $value = $this->asOrganizationGroupRoleAssigned()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.group.role.deleted':
                $value = $this->asOrganizationGroupRoleDeleted()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.member.added':
                $value = $this->asOrganizationMemberAdded()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.member.deleted':
                $value = $this->asOrganizationMemberDeleted()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.member.role.assigned':
                $value = $this->asOrganizationMemberRoleAssigned()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.member.role.deleted':
                $value = $this->asOrganizationMemberRoleDeleted()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'organization.updated':
                $value = $this->asOrganizationUpdated()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'user.created':
                $value = $this->asUserCreated()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'user.deleted':
                $value = $this->asUserDeleted()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'user.updated':
                $value = $this->asUserUpdated()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'error':
                $value = $this->asError()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case 'offset-only':
                $value = $this->asOffsetOnly()->jsonSerialize();
                $result = array_merge($value, $result);
                break;
            case '_unknown':
            default:
                if (is_null($this->value)) {
                    break;
                }
                if ($this->value instanceof JsonSerializableType) {
                    $value = $this->value->jsonSerialize();
                    $result = array_merge($value, $result);
                } elseif (is_array($this->value)) {
                    $result = array_merge($this->value, $result);
                }
        }

        return $result;
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function jsonDeserialize(array $data): static
    {
        $args = [];
        if (!array_key_exists('type', $data)) {
            throw new Exception(
                "JSON data is missing property 'type'",
            );
        }
        $type = $data['type'];
        if (!(is_string($type))) {
            throw new Exception(
                "Expected property 'type' in JSON data to be string, instead received " . get_debug_type($data['type']),
            );
        }

        $args['type'] = $type;
        switch ($type) {
            case 'group.created':
                $args['value'] = EventStreamCloudEventGroupCreated::jsonDeserialize($data);
                break;
            case 'group.deleted':
                $args['value'] = EventStreamCloudEventGroupDeleted::jsonDeserialize($data);
                break;
            case 'group.member.added':
                $args['value'] = EventStreamCloudEventGroupMemberAdded::jsonDeserialize($data);
                break;
            case 'group.member.deleted':
                $args['value'] = EventStreamCloudEventGroupMemberDeleted::jsonDeserialize($data);
                break;
            case 'group.role.assigned':
                $args['value'] = EventStreamCloudEventGroupRoleAssigned::jsonDeserialize($data);
                break;
            case 'group.role.deleted':
                $args['value'] = EventStreamCloudEventGroupRoleDeleted::jsonDeserialize($data);
                break;
            case 'group.updated':
                $args['value'] = EventStreamCloudEventGroupUpdated::jsonDeserialize($data);
                break;
            case 'organization.connection.added':
                $args['value'] = EventStreamCloudEventOrgConnectionAdded::jsonDeserialize($data);
                break;
            case 'organization.connection.removed':
                $args['value'] = EventStreamCloudEventOrgConnectionRemoved::jsonDeserialize($data);
                break;
            case 'organization.connection.updated':
                $args['value'] = EventStreamCloudEventOrgConnectionUpdated::jsonDeserialize($data);
                break;
            case 'organization.created':
                $args['value'] = EventStreamCloudEventOrgCreated::jsonDeserialize($data);
                break;
            case 'organization.deleted':
                $args['value'] = EventStreamCloudEventOrgDeleted::jsonDeserialize($data);
                break;
            case 'organization.group.role.assigned':
                $args['value'] = EventStreamCloudEventOrgGroupRoleAssigned::jsonDeserialize($data);
                break;
            case 'organization.group.role.deleted':
                $args['value'] = EventStreamCloudEventOrgGroupRoleDeleted::jsonDeserialize($data);
                break;
            case 'organization.member.added':
                $args['value'] = EventStreamCloudEventOrgMemberAdded::jsonDeserialize($data);
                break;
            case 'organization.member.deleted':
                $args['value'] = EventStreamCloudEventOrgMemberDeleted::jsonDeserialize($data);
                break;
            case 'organization.member.role.assigned':
                $args['value'] = EventStreamCloudEventOrgMemberRoleAssigned::jsonDeserialize($data);
                break;
            case 'organization.member.role.deleted':
                $args['value'] = EventStreamCloudEventOrgMemberRoleDeleted::jsonDeserialize($data);
                break;
            case 'organization.updated':
                $args['value'] = EventStreamCloudEventOrgUpdated::jsonDeserialize($data);
                break;
            case 'user.created':
                $args['value'] = EventStreamCloudEventUserCreated::jsonDeserialize($data);
                break;
            case 'user.deleted':
                $args['value'] = EventStreamCloudEventUserDeleted::jsonDeserialize($data);
                break;
            case 'user.updated':
                $args['value'] = EventStreamCloudEventUserUpdated::jsonDeserialize($data);
                break;
            case 'error':
                $args['value'] = EventStreamCloudEventErrorMessage::jsonDeserialize($data);
                break;
            case 'offset-only':
                $args['value'] = EventStreamCloudEventOffsetOnlyMessage::jsonDeserialize($data);
                break;
            case '_unknown':
            default:
                $args['type'] = '_unknown';
                $args['value'] = $data;
        }

        // @phpstan-ignore-next-line
        return new static($args);
    }
}
