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
     * @var (
     *    EventStreamCloudEventConnectionDeletedPreviousObject0
     *   |EventStreamCloudEventConnectionDeletedPreviousObject1
     *   |EventStreamCloudEventConnectionDeletedPreviousObject2
     *   |EventStreamCloudEventConnectionDeletedPreviousObject3
     *   |EventStreamCloudEventConnectionDeletedPreviousObject4
     *   |EventStreamCloudEventConnectionDeletedPreviousObject5
     *   |EventStreamCloudEventConnectionDeletedPreviousObject6
     *   |EventStreamCloudEventConnectionDeletedPreviousObject7
     * )|null $previousObject
     */
    #[JsonProperty('previous_object'), Union(EventStreamCloudEventConnectionDeletedPreviousObject0::class, EventStreamCloudEventConnectionDeletedPreviousObject1::class, EventStreamCloudEventConnectionDeletedPreviousObject2::class, EventStreamCloudEventConnectionDeletedPreviousObject3::class, EventStreamCloudEventConnectionDeletedPreviousObject4::class, EventStreamCloudEventConnectionDeletedPreviousObject5::class, EventStreamCloudEventConnectionDeletedPreviousObject6::class, EventStreamCloudEventConnectionDeletedPreviousObject7::class, 'null')]
    private EventStreamCloudEventConnectionDeletedPreviousObject0|EventStreamCloudEventConnectionDeletedPreviousObject1|EventStreamCloudEventConnectionDeletedPreviousObject2|EventStreamCloudEventConnectionDeletedPreviousObject3|EventStreamCloudEventConnectionDeletedPreviousObject4|EventStreamCloudEventConnectionDeletedPreviousObject5|EventStreamCloudEventConnectionDeletedPreviousObject6|EventStreamCloudEventConnectionDeletedPreviousObject7|null $previousObject;

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
     *   previousObject?: (
     *    EventStreamCloudEventConnectionDeletedPreviousObject0
     *   |EventStreamCloudEventConnectionDeletedPreviousObject1
     *   |EventStreamCloudEventConnectionDeletedPreviousObject2
     *   |EventStreamCloudEventConnectionDeletedPreviousObject3
     *   |EventStreamCloudEventConnectionDeletedPreviousObject4
     *   |EventStreamCloudEventConnectionDeletedPreviousObject5
     *   |EventStreamCloudEventConnectionDeletedPreviousObject6
     *   |EventStreamCloudEventConnectionDeletedPreviousObject7
     * )|null,
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
     * @return (
     *    EventStreamCloudEventConnectionDeletedPreviousObject0
     *   |EventStreamCloudEventConnectionDeletedPreviousObject1
     *   |EventStreamCloudEventConnectionDeletedPreviousObject2
     *   |EventStreamCloudEventConnectionDeletedPreviousObject3
     *   |EventStreamCloudEventConnectionDeletedPreviousObject4
     *   |EventStreamCloudEventConnectionDeletedPreviousObject5
     *   |EventStreamCloudEventConnectionDeletedPreviousObject6
     *   |EventStreamCloudEventConnectionDeletedPreviousObject7
     * )|null
     */
    public function getPreviousObject(): EventStreamCloudEventConnectionDeletedPreviousObject0|EventStreamCloudEventConnectionDeletedPreviousObject1|EventStreamCloudEventConnectionDeletedPreviousObject2|EventStreamCloudEventConnectionDeletedPreviousObject3|EventStreamCloudEventConnectionDeletedPreviousObject4|EventStreamCloudEventConnectionDeletedPreviousObject5|EventStreamCloudEventConnectionDeletedPreviousObject6|EventStreamCloudEventConnectionDeletedPreviousObject7|null
    {
        return $this->previousObject;
    }

    /**
     * @param (
     *    EventStreamCloudEventConnectionDeletedPreviousObject0
     *   |EventStreamCloudEventConnectionDeletedPreviousObject1
     *   |EventStreamCloudEventConnectionDeletedPreviousObject2
     *   |EventStreamCloudEventConnectionDeletedPreviousObject3
     *   |EventStreamCloudEventConnectionDeletedPreviousObject4
     *   |EventStreamCloudEventConnectionDeletedPreviousObject5
     *   |EventStreamCloudEventConnectionDeletedPreviousObject6
     *   |EventStreamCloudEventConnectionDeletedPreviousObject7
     * )|null $value
     */
    public function setPreviousObject(EventStreamCloudEventConnectionDeletedPreviousObject0|EventStreamCloudEventConnectionDeletedPreviousObject1|EventStreamCloudEventConnectionDeletedPreviousObject2|EventStreamCloudEventConnectionDeletedPreviousObject3|EventStreamCloudEventConnectionDeletedPreviousObject4|EventStreamCloudEventConnectionDeletedPreviousObject5|EventStreamCloudEventConnectionDeletedPreviousObject6|EventStreamCloudEventConnectionDeletedPreviousObject7|null $value = null): self
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
