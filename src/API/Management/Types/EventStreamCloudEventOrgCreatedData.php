<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgCreatedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgCreatedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgCreatedObject $object;

    /**
     * @var ?EventStreamCloudEventOrgCreatedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventOrgCreatedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgCreatedObject,
     *   previousObject?: ?EventStreamCloudEventOrgCreatedPreviousObject,
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
     * @return EventStreamCloudEventOrgCreatedObject
     */
    public function getObject(): EventStreamCloudEventOrgCreatedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgCreatedObject $value
     */
    public function setObject(EventStreamCloudEventOrgCreatedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgCreatedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventOrgCreatedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventOrgCreatedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventOrgCreatedPreviousObject $value = null): self
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
