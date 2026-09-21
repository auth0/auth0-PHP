<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event payload.
 */
class EventStreamCloudEventConnectionUpdatedData extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventConnectionUpdatedObject0
     *   |EventStreamCloudEventConnectionUpdatedObject1
     *   |EventStreamCloudEventConnectionUpdatedObject2
     *   |EventStreamCloudEventConnectionUpdatedObject3
     *   |EventStreamCloudEventConnectionUpdatedObject4
     *   |EventStreamCloudEventConnectionUpdatedObject5
     *   |EventStreamCloudEventConnectionUpdatedObject6
     *   |EventStreamCloudEventConnectionUpdatedObject7
     * ) $object
     */
    #[JsonProperty('object'), Union(EventStreamCloudEventConnectionUpdatedObject0::class, EventStreamCloudEventConnectionUpdatedObject1::class, EventStreamCloudEventConnectionUpdatedObject2::class, EventStreamCloudEventConnectionUpdatedObject3::class, EventStreamCloudEventConnectionUpdatedObject4::class, EventStreamCloudEventConnectionUpdatedObject5::class, EventStreamCloudEventConnectionUpdatedObject6::class, EventStreamCloudEventConnectionUpdatedObject7::class)]
    private EventStreamCloudEventConnectionUpdatedObject0|EventStreamCloudEventConnectionUpdatedObject1|EventStreamCloudEventConnectionUpdatedObject2|EventStreamCloudEventConnectionUpdatedObject3|EventStreamCloudEventConnectionUpdatedObject4|EventStreamCloudEventConnectionUpdatedObject5|EventStreamCloudEventConnectionUpdatedObject6|EventStreamCloudEventConnectionUpdatedObject7 $object;

    /**
     * @var (
     *    EventStreamCloudEventConnectionUpdatedPreviousObject0
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject1
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject2
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject3
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject4
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject5
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject6
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject7
     * )|null $previousObject
     */
    #[JsonProperty('previous_object'), Union(EventStreamCloudEventConnectionUpdatedPreviousObject0::class, EventStreamCloudEventConnectionUpdatedPreviousObject1::class, EventStreamCloudEventConnectionUpdatedPreviousObject2::class, EventStreamCloudEventConnectionUpdatedPreviousObject3::class, EventStreamCloudEventConnectionUpdatedPreviousObject4::class, EventStreamCloudEventConnectionUpdatedPreviousObject5::class, EventStreamCloudEventConnectionUpdatedPreviousObject6::class, EventStreamCloudEventConnectionUpdatedPreviousObject7::class, 'null')]
    private EventStreamCloudEventConnectionUpdatedPreviousObject0|EventStreamCloudEventConnectionUpdatedPreviousObject1|EventStreamCloudEventConnectionUpdatedPreviousObject2|EventStreamCloudEventConnectionUpdatedPreviousObject3|EventStreamCloudEventConnectionUpdatedPreviousObject4|EventStreamCloudEventConnectionUpdatedPreviousObject5|EventStreamCloudEventConnectionUpdatedPreviousObject6|EventStreamCloudEventConnectionUpdatedPreviousObject7|null $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: (
     *    EventStreamCloudEventConnectionUpdatedObject0
     *   |EventStreamCloudEventConnectionUpdatedObject1
     *   |EventStreamCloudEventConnectionUpdatedObject2
     *   |EventStreamCloudEventConnectionUpdatedObject3
     *   |EventStreamCloudEventConnectionUpdatedObject4
     *   |EventStreamCloudEventConnectionUpdatedObject5
     *   |EventStreamCloudEventConnectionUpdatedObject6
     *   |EventStreamCloudEventConnectionUpdatedObject7
     * ),
     *   previousObject?: (
     *    EventStreamCloudEventConnectionUpdatedPreviousObject0
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject1
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject2
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject3
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject4
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject5
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject6
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject7
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
     *    EventStreamCloudEventConnectionUpdatedObject0
     *   |EventStreamCloudEventConnectionUpdatedObject1
     *   |EventStreamCloudEventConnectionUpdatedObject2
     *   |EventStreamCloudEventConnectionUpdatedObject3
     *   |EventStreamCloudEventConnectionUpdatedObject4
     *   |EventStreamCloudEventConnectionUpdatedObject5
     *   |EventStreamCloudEventConnectionUpdatedObject6
     *   |EventStreamCloudEventConnectionUpdatedObject7
     * )
     */
    public function getObject(): EventStreamCloudEventConnectionUpdatedObject0|EventStreamCloudEventConnectionUpdatedObject1|EventStreamCloudEventConnectionUpdatedObject2|EventStreamCloudEventConnectionUpdatedObject3|EventStreamCloudEventConnectionUpdatedObject4|EventStreamCloudEventConnectionUpdatedObject5|EventStreamCloudEventConnectionUpdatedObject6|EventStreamCloudEventConnectionUpdatedObject7
    {
        return $this->object;
    }

    /**
     * @param (
     *    EventStreamCloudEventConnectionUpdatedObject0
     *   |EventStreamCloudEventConnectionUpdatedObject1
     *   |EventStreamCloudEventConnectionUpdatedObject2
     *   |EventStreamCloudEventConnectionUpdatedObject3
     *   |EventStreamCloudEventConnectionUpdatedObject4
     *   |EventStreamCloudEventConnectionUpdatedObject5
     *   |EventStreamCloudEventConnectionUpdatedObject6
     *   |EventStreamCloudEventConnectionUpdatedObject7
     * ) $value
     */
    public function setObject(EventStreamCloudEventConnectionUpdatedObject0|EventStreamCloudEventConnectionUpdatedObject1|EventStreamCloudEventConnectionUpdatedObject2|EventStreamCloudEventConnectionUpdatedObject3|EventStreamCloudEventConnectionUpdatedObject4|EventStreamCloudEventConnectionUpdatedObject5|EventStreamCloudEventConnectionUpdatedObject6|EventStreamCloudEventConnectionUpdatedObject7 $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventConnectionUpdatedPreviousObject0
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject1
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject2
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject3
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject4
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject5
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject6
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject7
     * )|null
     */
    public function getPreviousObject(): EventStreamCloudEventConnectionUpdatedPreviousObject0|EventStreamCloudEventConnectionUpdatedPreviousObject1|EventStreamCloudEventConnectionUpdatedPreviousObject2|EventStreamCloudEventConnectionUpdatedPreviousObject3|EventStreamCloudEventConnectionUpdatedPreviousObject4|EventStreamCloudEventConnectionUpdatedPreviousObject5|EventStreamCloudEventConnectionUpdatedPreviousObject6|EventStreamCloudEventConnectionUpdatedPreviousObject7|null
    {
        return $this->previousObject;
    }

    /**
     * @param (
     *    EventStreamCloudEventConnectionUpdatedPreviousObject0
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject1
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject2
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject3
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject4
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject5
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject6
     *   |EventStreamCloudEventConnectionUpdatedPreviousObject7
     * )|null $value
     */
    public function setPreviousObject(EventStreamCloudEventConnectionUpdatedPreviousObject0|EventStreamCloudEventConnectionUpdatedPreviousObject1|EventStreamCloudEventConnectionUpdatedPreviousObject2|EventStreamCloudEventConnectionUpdatedPreviousObject3|EventStreamCloudEventConnectionUpdatedPreviousObject4|EventStreamCloudEventConnectionUpdatedPreviousObject5|EventStreamCloudEventConnectionUpdatedPreviousObject6|EventStreamCloudEventConnectionUpdatedPreviousObject7|null $value = null): self
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
