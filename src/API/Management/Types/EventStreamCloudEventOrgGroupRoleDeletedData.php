<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgGroupRoleDeletedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgGroupRoleDeletedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgGroupRoleDeletedObject $object;

    /**
     * @var ?EventStreamCloudEventOrgGroupRoleDeletedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventOrgGroupRoleDeletedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgGroupRoleDeletedObject,
     *   previousObject?: ?EventStreamCloudEventOrgGroupRoleDeletedPreviousObject,
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
     * @return EventStreamCloudEventOrgGroupRoleDeletedObject
     */
    public function getObject(): EventStreamCloudEventOrgGroupRoleDeletedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleDeletedObject $value
     */
    public function setObject(EventStreamCloudEventOrgGroupRoleDeletedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgGroupRoleDeletedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventOrgGroupRoleDeletedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventOrgGroupRoleDeletedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventOrgGroupRoleDeletedPreviousObject $value = null): self
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
