<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamTestEventTypeEnum: string
{
    case GroupCreated = "group.created";
    case GroupDeleted = "group.deleted";
    case GroupMemberAdded = "group.member.added";
    case GroupMemberDeleted = "group.member.deleted";
    case GroupRoleAssigned = "group.role.assigned";
    case GroupRoleDeleted = "group.role.deleted";
    case GroupUpdated = "group.updated";
    case OrganizationConnectionAdded = "organization.connection.added";
    case OrganizationConnectionRemoved = "organization.connection.removed";
    case OrganizationConnectionUpdated = "organization.connection.updated";
    case OrganizationCreated = "organization.created";
    case OrganizationDeleted = "organization.deleted";
    case OrganizationGroupRoleAssigned = "organization.group.role.assigned";
    case OrganizationGroupRoleDeleted = "organization.group.role.deleted";
    case OrganizationMemberAdded = "organization.member.added";
    case OrganizationMemberDeleted = "organization.member.deleted";
    case OrganizationMemberRoleAssigned = "organization.member.role.assigned";
    case OrganizationMemberRoleDeleted = "organization.member.role.deleted";
    case OrganizationUpdated = "organization.updated";
    case UserCreated = "user.created";
    case UserDeleted = "user.deleted";
    case UserUpdated = "user.updated";
}
