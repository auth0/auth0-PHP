<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgMemberAddedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberAddedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgMemberAddedObject $object;

    /**
     * @var ?EventStreamCloudEventOrgMemberAddedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventOrgMemberAddedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgMemberAddedObject,
     *   previousObject?: ?EventStreamCloudEventOrgMemberAddedPreviousObject,
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
     * @return EventStreamCloudEventOrgMemberAddedObject
     */
    public function getObject(): EventStreamCloudEventOrgMemberAddedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgMemberAddedObject $value
     */
    public function setObject(EventStreamCloudEventOrgMemberAddedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgMemberAddedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventOrgMemberAddedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventOrgMemberAddedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventOrgMemberAddedPreviousObject $value = null): self
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
