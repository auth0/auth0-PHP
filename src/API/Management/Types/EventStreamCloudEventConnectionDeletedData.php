<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event payload.
 */
class EventStreamCloudEventConnectionDeletedData extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventConnectionDeletedObject0
     *   |EventStreamCloudEventConnectionDeletedObject1
     *   |EventStreamCloudEventConnectionDeletedObject2
     *   |EventStreamCloudEventConnectionDeletedObject3
     *   |EventStreamCloudEventConnectionDeletedObject4
     *   |EventStreamCloudEventConnectionDeletedObject5
     *   |EventStreamCloudEventConnectionDeletedObject6
     *   |EventStreamCloudEventConnectionDeletedObject7
     * ) $object
     */
    #[JsonProperty('object'), Union(EventStreamCloudEventConnectionDeletedObject0::class, EventStreamCloudEventConnectionDeletedObject1::class, EventStreamCloudEventConnectionDeletedObject2::class, EventStreamCloudEventConnectionDeletedObject3::class, EventStreamCloudEventConnectionDeletedObject4::class, EventStreamCloudEventConnectionDeletedObject5::class, EventStreamCloudEventConnectionDeletedObject6::class, EventStreamCloudEventConnectionDeletedObject7::class)]
    private EventStreamCloudEventConnectionDeletedObject0|EventStreamCloudEventConnectionDeletedObject1|EventStreamCloudEventConnectionDeletedObject2|EventStreamCloudEventConnectionDeletedObject3|EventStreamCloudEventConnectionDeletedObject4|EventStreamCloudEventConnectionDeletedObject5|EventStreamCloudEventConnectionDeletedObject6|EventStreamCloudEventConnectionDeletedObject7 $object;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: (
     *    EventStreamCloudEventConnectionDeletedObject0
     *   |EventStreamCloudEventConnectionDeletedObject1
     *   |EventStreamCloudEventConnectionDeletedObject2
     *   |EventStreamCloudEventConnectionDeletedObject3
     *   |EventStreamCloudEventConnectionDeletedObject4
     *   |EventStreamCloudEventConnectionDeletedObject5
     *   |EventStreamCloudEventConnectionDeletedObject6
     *   |EventStreamCloudEventConnectionDeletedObject7
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
     *    EventStreamCloudEventConnectionDeletedObject0
     *   |EventStreamCloudEventConnectionDeletedObject1
     *   |EventStreamCloudEventConnectionDeletedObject2
     *   |EventStreamCloudEventConnectionDeletedObject3
     *   |EventStreamCloudEventConnectionDeletedObject4
     *   |EventStreamCloudEventConnectionDeletedObject5
     *   |EventStreamCloudEventConnectionDeletedObject6
     *   |EventStreamCloudEventConnectionDeletedObject7
     * )
     */
    public function getObject(): EventStreamCloudEventConnectionDeletedObject0|EventStreamCloudEventConnectionDeletedObject1|EventStreamCloudEventConnectionDeletedObject2|EventStreamCloudEventConnectionDeletedObject3|EventStreamCloudEventConnectionDeletedObject4|EventStreamCloudEventConnectionDeletedObject5|EventStreamCloudEventConnectionDeletedObject6|EventStreamCloudEventConnectionDeletedObject7
    {
        return $this->object;
    }

    /**
     * @param (
     *    EventStreamCloudEventConnectionDeletedObject0
     *   |EventStreamCloudEventConnectionDeletedObject1
     *   |EventStreamCloudEventConnectionDeletedObject2
     *   |EventStreamCloudEventConnectionDeletedObject3
     *   |EventStreamCloudEventConnectionDeletedObject4
     *   |EventStreamCloudEventConnectionDeletedObject5
     *   |EventStreamCloudEventConnectionDeletedObject6
     *   |EventStreamCloudEventConnectionDeletedObject7
     * ) $value
     */
    public function setObject(EventStreamCloudEventConnectionDeletedObject0|EventStreamCloudEventConnectionDeletedObject1|EventStreamCloudEventConnectionDeletedObject2|EventStreamCloudEventConnectionDeletedObject3|EventStreamCloudEventConnectionDeletedObject4|EventStreamCloudEventConnectionDeletedObject5|EventStreamCloudEventConnectionDeletedObject6|EventStreamCloudEventConnectionDeletedObject7 $value): self
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
