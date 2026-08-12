<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event payload.
 */
class EventStreamCloudEventGroupRoleDeletedData extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventGroupRoleDeletedObject $object
     */
    #[JsonProperty('object')]
    private EventStreamCloudEventGroupRoleDeletedObject $object;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: EventStreamCloudEventGroupRoleDeletedObject,
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
     * @return EventStreamCloudEventGroupRoleDeletedObject
     */
    public function getObject(): EventStreamCloudEventGroupRoleDeletedObject
    {
        return $this->object;
    }

    /**
     * @param EventStreamCloudEventGroupRoleDeletedObject $value
     */
    public function setObject(EventStreamCloudEventGroupRoleDeletedObject $value): self
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
