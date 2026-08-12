<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgUpdatedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgUpdatedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgUpdatedObject $object;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgUpdatedObject,
     *   context?: ?EventStreamCloudEventContext,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->object = $values['object'];
        $this->context = $values['context'] ?? null;
    }

    /**
     * @return EventStreamCloudEventOrgUpdatedObject
     */
    public function getObject(): EventStreamCloudEventOrgUpdatedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgUpdatedObject $value
     */
    public function setObject(EventStreamCloudEventOrgUpdatedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
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
