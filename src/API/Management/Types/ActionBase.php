<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * The action to which this version belongs.
 */
class ActionBase extends JsonSerializableType
{
    /**
     * @var ?string $id The unique ID of the action.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name The name of an action.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?array<ActionTrigger> $supportedTriggers The list of triggers that this action supports. At this time, an action can only target a single trigger at a time.
     */
    #[JsonProperty('supported_triggers'), ArrayType([ActionTrigger::class])]
    private ?array $supportedTriggers;

    /**
     * @var ?bool $allChangesDeployed True if all of an Action's contents have been deployed.
     */
    #[JsonProperty('all_changes_deployed')]
    private ?bool $allChangesDeployed;

    /**
     * @var ?DateTime $createdAt The time when this action was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The time when this action was updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   supportedTriggers?: ?array<ActionTrigger>,
     *   allChangesDeployed?: ?bool,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->supportedTriggers = $values['supportedTriggers'] ?? null;
        $this->allChangesDeployed = $values['allChangesDeployed'] ?? null;
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
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?array<ActionTrigger>
     */
    public function getSupportedTriggers(): ?array
    {
        return $this->supportedTriggers;
    }

    /**
     * @param ?array<ActionTrigger> $value
     */
    public function setSupportedTriggers(?array $value = null): self
    {
        $this->supportedTriggers = $value;
        $this->_setField('supportedTriggers');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllChangesDeployed(): ?bool
    {
        return $this->allChangesDeployed;
    }

    /**
     * @param ?bool $value
     */
    public function setAllChangesDeployed(?bool $value = null): self
    {
        $this->allChangesDeployed = $value;
        $this->_setField('allChangesDeployed');
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
