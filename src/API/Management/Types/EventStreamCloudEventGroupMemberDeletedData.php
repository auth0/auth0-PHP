<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventGroupMemberDeletedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventGroupMemberDeletedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventGroupMemberDeletedObject $object;

    /**
     * @var ?EventStreamCloudEventGroupMemberDeletedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventGroupMemberDeletedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventGroupMemberDeletedObject,
     *   previousObject?: ?EventStreamCloudEventGroupMemberDeletedPreviousObject,
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
     * @return EventStreamCloudEventGroupMemberDeletedObject
     */
    public function getObject(): EventStreamCloudEventGroupMemberDeletedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventGroupMemberDeletedObject $value
     */
    public function setObject(EventStreamCloudEventGroupMemberDeletedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventGroupMemberDeletedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventGroupMemberDeletedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventGroupMemberDeletedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventGroupMemberDeletedPreviousObject $value = null): self
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
