<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Binding is the associative entity joining a trigger, and an action together.
 */
class ActionBinding extends JsonSerializableType
{
    /**
     * @var ?string $id The unique ID of this binding.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?value-of<ActionTriggerTypeEnum> $triggerId
     */
    #[JsonProperty('trigger_id')]
    private ?string $triggerId;

    /**
     * @var ?string $displayName The name of the binding.
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?Action $action
     */
    #[JsonProperty('action')]
    private ?Action $action;

    /**
     * @var ?DateTime $createdAt The time when the binding was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The time when the binding was updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   triggerId?: ?value-of<ActionTriggerTypeEnum>,
     *   displayName?: ?string,
     *   action?: ?Action,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->triggerId = $values['triggerId'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->action = $values['action'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?value-of<ActionTriggerTypeEnum>
     */
    public function getTriggerId(): ?string
    {
        return $this->triggerId;
    }

    /**
     * @param ?value-of<ActionTriggerTypeEnum> $value
     */
    public function setTriggerId(?string $value = null): self
    {
        $this->triggerId = $value;
        $this->_setField('triggerId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param ?string $value
     */
    public function setDisplayName(?string $value = null): self
    {
        $this->displayName = $value;
        $this->_setField('displayName');
        return $this;
    }

    /**
     * @return ?Action
     */
    public function getAction(): ?Action
    {
        return $this->action;
    }

    /**
     * @param ?Action $value
     */
    public function setAction(?Action $value = null): self
    {
        $this->action = $value;
        $this->_setField('action');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setUpdatedAt(?DateTime $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
