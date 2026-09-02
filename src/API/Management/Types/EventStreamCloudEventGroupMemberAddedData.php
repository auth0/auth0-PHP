<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventGroupMemberAddedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventGroupMemberAddedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventGroupMemberAddedObject $object;

    /**
     * @var ?EventStreamCloudEventGroupMemberAddedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventGroupMemberAddedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventGroupMemberAddedObject,
     *   previousObject?: ?EventStreamCloudEventGroupMemberAddedPreviousObject,
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
     * @return EventStreamCloudEventGroupMemberAddedObject
     */
    public function getObject(): EventStreamCloudEventGroupMemberAddedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventGroupMemberAddedObject $value
     */
    public function setObject(EventStreamCloudEventGroupMemberAddedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventGroupMemberAddedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventGroupMemberAddedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventGroupMemberAddedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventGroupMemberAddedPreviousObject $value = null): self
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
