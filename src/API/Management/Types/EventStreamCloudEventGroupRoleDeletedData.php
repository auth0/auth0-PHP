<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventGroupRoleDeletedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventGroupRoleDeletedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventGroupRoleDeletedObject $object;

    /**
     * @var ?EventStreamCloudEventGroupRoleDeletedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventGroupRoleDeletedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventGroupRoleDeletedObject,
     *   previousObject?: ?EventStreamCloudEventGroupRoleDeletedPreviousObject,
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
     * @return EventStreamCloudEventGroupRoleDeletedObject
     */
    public function getObject(): EventStreamCloudEventGroupRoleDeletedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventGroupRoleDeletedObject $value
     */
    public function setObject(EventStreamCloudEventGroupRoleDeletedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventGroupRoleDeletedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventGroupRoleDeletedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventGroupRoleDeletedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventGroupRoleDeletedPreviousObject $value = null): self
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
