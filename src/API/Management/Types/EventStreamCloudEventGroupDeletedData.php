<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event payload.
 */
class EventStreamCloudEventGroupDeletedData extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupDeletedObject0
     *   |EventStreamCloudEventGroupDeletedObject1
     *   |EventStreamCloudEventGroupDeletedObject2
     * ) $object
     */
    #[JsonProperty('object'), Union(EventStreamCloudEventGroupDeletedObject0::class, EventStreamCloudEventGroupDeletedObject1::class, EventStreamCloudEventGroupDeletedObject2::class)]
    private EventStreamCloudEventGroupDeletedObject0|EventStreamCloudEventGroupDeletedObject1|EventStreamCloudEventGroupDeletedObject2 $object;

    /**
     * @var (
     *    EventStreamCloudEventGroupDeletedPreviousObject0
     *   |EventStreamCloudEventGroupDeletedPreviousObject1
     *   |EventStreamCloudEventGroupDeletedPreviousObject2
     * )|null $previousObject
     */
    #[JsonProperty('previous_object'), Union(EventStreamCloudEventGroupDeletedPreviousObject0::class, EventStreamCloudEventGroupDeletedPreviousObject1::class, EventStreamCloudEventGroupDeletedPreviousObject2::class, 'null')]
    private EventStreamCloudEventGroupDeletedPreviousObject0|EventStreamCloudEventGroupDeletedPreviousObject1|EventStreamCloudEventGroupDeletedPreviousObject2|null $previousObject;

    /**
     * @var ?EventStreamCloudEventContext $context
     */
    #[JsonProperty('context')]
    private ?EventStreamCloudEventContext $context;

    /**
     * @param array{
     *   object: (
     *    EventStreamCloudEventGroupDeletedObject0
     *   |EventStreamCloudEventGroupDeletedObject1
     *   |EventStreamCloudEventGroupDeletedObject2
     * ),
     *   previousObject?: (
     *    EventStreamCloudEventGroupDeletedPreviousObject0
     *   |EventStreamCloudEventGroupDeletedPreviousObject1
     *   |EventStreamCloudEventGroupDeletedPreviousObject2
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
     *    EventStreamCloudEventGroupDeletedObject0
     *   |EventStreamCloudEventGroupDeletedObject1
     *   |EventStreamCloudEventGroupDeletedObject2
     * )
     */
    public function getObject(): EventStreamCloudEventGroupDeletedObject0|EventStreamCloudEventGroupDeletedObject1|EventStreamCloudEventGroupDeletedObject2
    {
        return $this->object;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupDeletedObject0
     *   |EventStreamCloudEventGroupDeletedObject1
     *   |EventStreamCloudEventGroupDeletedObject2
     * ) $value
     */
    public function setObject(EventStreamCloudEventGroupDeletedObject0|EventStreamCloudEventGroupDeletedObject1|EventStreamCloudEventGroupDeletedObject2 $value): self
    {
        $this->object = $value;
        $this->_setField('object');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventGroupDeletedPreviousObject0
     *   |EventStreamCloudEventGroupDeletedPreviousObject1
     *   |EventStreamCloudEventGroupDeletedPreviousObject2
     * )|null
     */
    public function getPreviousObject(): EventStreamCloudEventGroupDeletedPreviousObject0|EventStreamCloudEventGroupDeletedPreviousObject1|EventStreamCloudEventGroupDeletedPreviousObject2|null
    {
        return $this->previousObject;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupDeletedPreviousObject0
     *   |EventStreamCloudEventGroupDeletedPreviousObject1
     *   |EventStreamCloudEventGroupDeletedPreviousObject2
     * )|null $value
     */
    public function setPreviousObject(EventStreamCloudEventGroupDeletedPreviousObject0|EventStreamCloudEventGroupDeletedPreviousObject1|EventStreamCloudEventGroupDeletedPreviousObject2|null $value = null): self
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
