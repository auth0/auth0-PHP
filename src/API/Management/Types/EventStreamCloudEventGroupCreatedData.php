<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event payload.
 */
class EventStreamCloudEventGroupCreatedData extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupCreatedObject0
     *   |EventStreamCloudEventGroupCreatedObject1
     *   |EventStreamCloudEventGroupCreatedObject2
     * ) $object
     */
    #[JsonProperty('object'), Union(EventStreamCloudEventGroupCreatedObject0::class, EventStreamCloudEventGroupCreatedObject1::class, EventStreamCloudEventGroupCreatedObject2::class)]
    private EventStreamCloudEventGroupCreatedObject0|EventStreamCloudEventGroupCreatedObject1|EventStreamCloudEventGroupCreatedObject2 $object;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: (
     *    EventStreamCloudEventGroupCreatedObject0
     *   |EventStreamCloudEventGroupCreatedObject1
     *   |EventStreamCloudEventGroupCreatedObject2
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
     *    EventStreamCloudEventGroupCreatedObject0
     *   |EventStreamCloudEventGroupCreatedObject1
     *   |EventStreamCloudEventGroupCreatedObject2
     * )
     */
    public function getObject(): EventStreamCloudEventGroupCreatedObject0|EventStreamCloudEventGroupCreatedObject1|EventStreamCloudEventGroupCreatedObject2
    {
        return $this->object;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupCreatedObject0
     *   |EventStreamCloudEventGroupCreatedObject1
     *   |EventStreamCloudEventGroupCreatedObject2
     * ) $value
     */
    public function setObject(EventStreamCloudEventGroupCreatedObject0|EventStreamCloudEventGroupCreatedObject1|EventStreamCloudEventGroupCreatedObject2 $value): self
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
