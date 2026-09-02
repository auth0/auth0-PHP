<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgMemberRoleDeletedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberRoleDeletedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgMemberRoleDeletedObject $object;

    /**
     * @var ?EventStreamCloudEventOrgMemberRoleDeletedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventOrgMemberRoleDeletedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgMemberRoleDeletedObject,
     *   previousObject?: ?EventStreamCloudEventOrgMemberRoleDeletedPreviousObject,
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
     * @return EventStreamCloudEventOrgMemberRoleDeletedObject
     */
    public function getObject(): EventStreamCloudEventOrgMemberRoleDeletedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleDeletedObject $value
     */
    public function setObject(EventStreamCloudEventOrgMemberRoleDeletedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgMemberRoleDeletedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventOrgMemberRoleDeletedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventOrgMemberRoleDeletedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventOrgMemberRoleDeletedPreviousObject $value = null): self
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
