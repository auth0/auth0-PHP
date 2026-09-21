<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventUserCreatedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventUserCreatedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventUserCreatedObject $object;

    /**
     * @var ?EventStreamCloudEventUserCreatedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventUserCreatedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventUserCreatedObject,
     *   previousObject?: ?EventStreamCloudEventUserCreatedPreviousObject,
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
     * @return EventStreamCloudEventUserCreatedObject
     */
    public function getObject(): EventStreamCloudEventUserCreatedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventUserCreatedObject $value
     */
    public function setObject(EventStreamCloudEventUserCreatedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventUserCreatedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventUserCreatedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventUserCreatedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventUserCreatedPreviousObject $value = null): self
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
