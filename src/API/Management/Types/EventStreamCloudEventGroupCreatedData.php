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
     * @var (
     *    EventStreamCloudEventGroupCreatedPreviousObject0
     *   |EventStreamCloudEventGroupCreatedPreviousObject1
     *   |EventStreamCloudEventGroupCreatedPreviousObject2
     * )|null $previousObject
     */
    #[JsonProperty('previous_object'), Union(EventStreamCloudEventGroupCreatedPreviousObject0::class, EventStreamCloudEventGroupCreatedPreviousObject1::class, EventStreamCloudEventGroupCreatedPreviousObject2::class, 'null')]
    private EventStreamCloudEventGroupCreatedPreviousObject0|EventStreamCloudEventGroupCreatedPreviousObject1|EventStreamCloudEventGroupCreatedPreviousObject2|null $previousObject;

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
     *   previousObject?: (
     *    EventStreamCloudEventGroupCreatedPreviousObject0
     *   |EventStreamCloudEventGroupCreatedPreviousObject1
     *   |EventStreamCloudEventGroupCreatedPreviousObject2
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
     * @return (
     *    EventStreamCloudEventGroupCreatedPreviousObject0
     *   |EventStreamCloudEventGroupCreatedPreviousObject1
     *   |EventStreamCloudEventGroupCreatedPreviousObject2
     * )|null
     */
    public function getPreviousObject(): EventStreamCloudEventGroupCreatedPreviousObject0|EventStreamCloudEventGroupCreatedPreviousObject1|EventStreamCloudEventGroupCreatedPreviousObject2|null
    {
        return $this->previousObject;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupCreatedPreviousObject0
     *   |EventStreamCloudEventGroupCreatedPreviousObject1
     *   |EventStreamCloudEventGroupCreatedPreviousObject2
     * )|null $value
     */
    public function setPreviousObject(EventStreamCloudEventGroupCreatedPreviousObject0|EventStreamCloudEventGroupCreatedPreviousObject1|EventStreamCloudEventGroupCreatedPreviousObject2|null $value = null): self
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
