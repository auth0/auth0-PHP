<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgConnectionUpdatedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgConnectionUpdatedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgConnectionUpdatedObject $object;

    /**
     * @var ?EventStreamCloudEventOrgConnectionUpdatedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventOrgConnectionUpdatedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgConnectionUpdatedObject,
     *   previousObject?: ?EventStreamCloudEventOrgConnectionUpdatedPreviousObject,
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
     * @return EventStreamCloudEventOrgConnectionUpdatedObject
     */
    public function getObject(): EventStreamCloudEventOrgConnectionUpdatedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgConnectionUpdatedObject $value
     */
    public function setObject(EventStreamCloudEventOrgConnectionUpdatedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgConnectionUpdatedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventOrgConnectionUpdatedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventOrgConnectionUpdatedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventOrgConnectionUpdatedPreviousObject $value = null): self
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
