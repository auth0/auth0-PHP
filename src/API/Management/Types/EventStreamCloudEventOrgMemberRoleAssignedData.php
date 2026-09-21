<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgMemberRoleAssignedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberRoleAssignedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgMemberRoleAssignedObject $object;

    /**
     * @var ?EventStreamCloudEventOrgMemberRoleAssignedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventOrgMemberRoleAssignedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgMemberRoleAssignedObject,
     *   previousObject?: ?EventStreamCloudEventOrgMemberRoleAssignedPreviousObject,
     *   context?: ?EventStreamCloudEventContext,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->object = $values['object'];
        $this->previousObject = $values['previousObject'] ?? null;
        $this->context = $values['context'] ?? null;
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleAssignedObject
     */
    public function getObject(): EventStreamCloudEventOrgMemberRoleAssignedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleAssignedObject $value
     */
    public function setObject(EventStreamCloudEventOrgMemberRoleAssignedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgMemberRoleAssignedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventOrgMemberRoleAssignedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventOrgMemberRoleAssignedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventOrgMemberRoleAssignedPreviousObject $value = null): self
    {
        $this->previousObject = $value;
        $this->_setField('previousObject');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventContext
     */
    public function getContext(): ?EventStreamCloudEventContext
    {
        return $this->context;
    }

    /**
     * @param ?EventStreamCloudEventContext $value
     */
    public function setContext(?EventStreamCloudEventContext $value = null): self
    {
        $this->context = $value;
        $this->_setField('context');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
