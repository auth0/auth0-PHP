<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgConnectionAddedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgConnectionAddedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgConnectionAddedObject $object;

    /**
     * @var ?EventStreamCloudEventOrgConnectionAddedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventOrgConnectionAddedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgConnectionAddedObject,
     *   previousObject?: ?EventStreamCloudEventOrgConnectionAddedPreviousObject,
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
     * @return EventStreamCloudEventOrgConnectionAddedObject
     */
    public function getObject(): EventStreamCloudEventOrgConnectionAddedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgConnectionAddedObject $value
     */
    public function setObject(EventStreamCloudEventOrgConnectionAddedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgConnectionAddedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventOrgConnectionAddedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventOrgConnectionAddedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventOrgConnectionAddedPreviousObject $value = null): self
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
