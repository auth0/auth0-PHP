<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event payload.
 */
class EventStreamCloudEventGroupUpdatedData extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupUpdatedObject0
     *   |EventStreamCloudEventGroupUpdatedObject1
     *   |EventStreamCloudEventGroupUpdatedObject2
     * ) $object
     */
    #[JsonProperty('object'), Union(EventStreamCloudEventGroupUpdatedObject0::class, EventStreamCloudEventGroupUpdatedObject1::class, EventStreamCloudEventGroupUpdatedObject2::class)]
    private EventStreamCloudEventGroupUpdatedObject0|EventStreamCloudEventGroupUpdatedObject1|EventStreamCloudEventGroupUpdatedObject2 $object;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: (
     *    EventStreamCloudEventGroupUpdatedObject0
     *   |EventStreamCloudEventGroupUpdatedObject1
     *   |EventStreamCloudEventGroupUpdatedObject2
     * ),
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
     * @return (
     *    EventStreamCloudEventGroupUpdatedObject0
     *   |EventStreamCloudEventGroupUpdatedObject1
     *   |EventStreamCloudEventGroupUpdatedObject2
     * )
     */
    public function getObject(): EventStreamCloudEventGroupUpdatedObject0|EventStreamCloudEventGroupUpdatedObject1|EventStreamCloudEventGroupUpdatedObject2
    {
        return $this->object;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupUpdatedObject0
     *   |EventStreamCloudEventGroupUpdatedObject1
     *   |EventStreamCloudEventGroupUpdatedObject2
     * ) $value
     */
    public function setObject(EventStreamCloudEventGroupUpdatedObject0|EventStreamCloudEventGroupUpdatedObject1|EventStreamCloudEventGroupUpdatedObject2 $value): self
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
