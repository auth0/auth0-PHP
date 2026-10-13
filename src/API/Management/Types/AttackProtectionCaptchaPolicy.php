<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * An attack protection policy override for CAPTCHA.
 */
class AttackProtectionCaptchaPolicy extends JsonSerializableType
{
    /**
     * @var string $id System-generated identifier for the policy.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $name Human-readable policy name.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description Description of the policy's purpose.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var int $priority Conflict resolution order. Lower number takes higher precedence.
     */
    #[JsonProperty('priority')]
    private int $priority;

    /**
     * @var AttackProtectionCaptchaPolicyMatch $match
     */
    #[JsonProperty('match')]
    private AttackProtectionCaptchaPolicyMatch $match;

    /**
     * @var AttackProtectionCaptchaPolicyAction $action
     */
    #[JsonProperty('action')]
    private AttackProtectionCaptchaPolicyAction $action;

    /**
     * @var DateTime $createdAt ISO 8601 timestamp when the policy was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt ISO 8601 timestamp when the policy was last updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   priority: int,
     *   match: AttackProtectionCaptchaPolicyMatch,
     *   action: AttackProtectionCaptchaPolicyAction,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->priority = $values['priority'];
        $this->match = $values['match'];
        $this->action = $values['action'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $value
     */
    public function setPriority(int $value): self
    {
        $this->priority = $value;
        $this->_setField('priority');
        return $this;
    }

    /**
     * @return AttackProtectionCaptchaPolicyMatch
     */
    public function getMatch(): AttackProtectionCaptchaPolicyMatch
    {
        return $this->match;
    }

    /**
     * @param AttackProtectionCaptchaPolicyMatch $value
     */
    public function setMatch(AttackProtectionCaptchaPolicyMatch $value): self
    {
        $this->match = $value;
        $this->_setField('match');
        return $this;
    }

    /**
     * @return AttackProtectionCaptchaPolicyAction
     */
    public function getAction(): AttackProtectionCaptchaPolicyAction
    {
        return $this->action;
    }

    /**
     * @param AttackProtectionCaptchaPolicyAction $value
     */
    public function setAction(AttackProtectionCaptchaPolicyAction $value): self
    {
        $this->action = $value;
        $this->_setField('action');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
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
