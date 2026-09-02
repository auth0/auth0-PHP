<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgConnectionRemovedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgConnectionRemovedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgConnectionRemovedObject $object;

    /**
     * @var ?EventStreamCloudEventOrgConnectionRemovedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventOrgConnectionRemovedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgConnectionRemovedObject,
     *   previousObject?: ?EventStreamCloudEventOrgConnectionRemovedPreviousObject,
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
     * @return EventStreamCloudEventOrgConnectionRemovedObject
     */
    public function getObject(): EventStreamCloudEventOrgConnectionRemovedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgConnectionRemovedObject $value
     */
    public function setObject(EventStreamCloudEventOrgConnectionRemovedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgConnectionRemovedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventOrgConnectionRemovedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventOrgConnectionRemovedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventOrgConnectionRemovedPreviousObject $value = null): self
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
