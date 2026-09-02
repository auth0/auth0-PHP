<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventUserUpdatedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventUserUpdatedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventUserUpdatedObject $object;

    /**
     * @var ?EventStreamCloudEventUserUpdatedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventUserUpdatedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventUserUpdatedObject,
     *   previousObject?: ?EventStreamCloudEventUserUpdatedPreviousObject,
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
     * @return EventStreamCloudEventUserUpdatedObject
     */
    public function getObject(): EventStreamCloudEventUserUpdatedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventUserUpdatedObject $value
     */
    public function setObject(EventStreamCloudEventUserUpdatedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventUserUpdatedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventUserUpdatedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventUserUpdatedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventUserUpdatedPreviousObject $value = null): self
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
