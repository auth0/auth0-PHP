<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event payload.
 */
class EventStreamCloudEventConnectionCreatedData extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventConnectionCreatedObject0
     *   |EventStreamCloudEventConnectionCreatedObject1
     *   |EventStreamCloudEventConnectionCreatedObject2
     *   |EventStreamCloudEventConnectionCreatedObject3
     *   |EventStreamCloudEventConnectionCreatedObject4
     *   |EventStreamCloudEventConnectionCreatedObject5
     *   |EventStreamCloudEventConnectionCreatedObject6
     *   |EventStreamCloudEventConnectionCreatedObject7
     * ) $object
     */
    #[JsonProperty('object'), Union(EventStreamCloudEventConnectionCreatedObject0::class, EventStreamCloudEventConnectionCreatedObject1::class, EventStreamCloudEventConnectionCreatedObject2::class, EventStreamCloudEventConnectionCreatedObject3::class, EventStreamCloudEventConnectionCreatedObject4::class, EventStreamCloudEventConnectionCreatedObject5::class, EventStreamCloudEventConnectionCreatedObject6::class, EventStreamCloudEventConnectionCreatedObject7::class)]
    private EventStreamCloudEventConnectionCreatedObject0|EventStreamCloudEventConnectionCreatedObject1|EventStreamCloudEventConnectionCreatedObject2|EventStreamCloudEventConnectionCreatedObject3|EventStreamCloudEventConnectionCreatedObject4|EventStreamCloudEventConnectionCreatedObject5|EventStreamCloudEventConnectionCreatedObject6|EventStreamCloudEventConnectionCreatedObject7 $object;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: (
     *    EventStreamCloudEventConnectionCreatedObject0
     *   |EventStreamCloudEventConnectionCreatedObject1
     *   |EventStreamCloudEventConnectionCreatedObject2
     *   |EventStreamCloudEventConnectionCreatedObject3
     *   |EventStreamCloudEventConnectionCreatedObject4
     *   |EventStreamCloudEventConnectionCreatedObject5
     *   |EventStreamCloudEventConnectionCreatedObject6
     *   |EventStreamCloudEventConnectionCreatedObject7
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
     *    EventStreamCloudEventConnectionCreatedObject0
     *   |EventStreamCloudEventConnectionCreatedObject1
     *   |EventStreamCloudEventConnectionCreatedObject2
     *   |EventStreamCloudEventConnectionCreatedObject3
     *   |EventStreamCloudEventConnectionCreatedObject4
     *   |EventStreamCloudEventConnectionCreatedObject5
     *   |EventStreamCloudEventConnectionCreatedObject6
     *   |EventStreamCloudEventConnectionCreatedObject7
     * )
     */
    public function getObject(): EventStreamCloudEventConnectionCreatedObject0|EventStreamCloudEventConnectionCreatedObject1|EventStreamCloudEventConnectionCreatedObject2|EventStreamCloudEventConnectionCreatedObject3|EventStreamCloudEventConnectionCreatedObject4|EventStreamCloudEventConnectionCreatedObject5|EventStreamCloudEventConnectionCreatedObject6|EventStreamCloudEventConnectionCreatedObject7
    {
        return $this->object;
    }

    /**
     * @param (
     *    EventStreamCloudEventConnectionCreatedObject0
     *   |EventStreamCloudEventConnectionCreatedObject1
     *   |EventStreamCloudEventConnectionCreatedObject2
     *   |EventStreamCloudEventConnectionCreatedObject3
     *   |EventStreamCloudEventConnectionCreatedObject4
     *   |EventStreamCloudEventConnectionCreatedObject5
     *   |EventStreamCloudEventConnectionCreatedObject6
     *   |EventStreamCloudEventConnectionCreatedObject7
     * ) $value
     */
    public function setObject(EventStreamCloudEventConnectionCreatedObject0|EventStreamCloudEventConnectionCreatedObject1|EventStreamCloudEventConnectionCreatedObject2|EventStreamCloudEventConnectionCreatedObject3|EventStreamCloudEventConnectionCreatedObject4|EventStreamCloudEventConnectionCreatedObject5|EventStreamCloudEventConnectionCreatedObject6|EventStreamCloudEventConnectionCreatedObject7 $value): self
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
