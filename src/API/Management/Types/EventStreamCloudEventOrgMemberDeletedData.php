<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventOrgMemberDeletedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberDeletedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventOrgMemberDeletedObject $object;

    /**
     * @var ?EventStreamCloudEventOrgMemberDeletedPreviousObject $previousObject
     */
    #[JsonProperty('previous_object')]
    private ?EventStreamCloudEventOrgMemberDeletedPreviousObject $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventOrgMemberDeletedObject,
     *   previousObject?: ?EventStreamCloudEventOrgMemberDeletedPreviousObject,
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
     * @return EventStreamCloudEventOrgMemberDeletedObject
     */
    public function getObject(): EventStreamCloudEventOrgMemberDeletedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventOrgMemberDeletedObject $value
     */
    public function setObject(EventStreamCloudEventOrgMemberDeletedObject $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgMemberDeletedPreviousObject
     */
    public function getPreviousObject(): ?EventStreamCloudEventOrgMemberDeletedPreviousObject
    {
        return $this->previousObject;
    }

    /**
     * @param ?EventStreamCloudEventOrgMemberDeletedPreviousObject $value
     */
    public function setPreviousObject(?EventStreamCloudEventOrgMemberDeletedPreviousObject $value = null): self
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
