<?php

namespace Auth0\SDK\API\Management\AttackProtection\CaptchaPolicies\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\AttackProtectionCaptchaPolicyMatch;
use Auth0\SDK\API\Management\Types\AttackProtectionCaptchaPolicyActionInput;

class CreateAttackProtectionCaptchaPolicyRequestContent extends JsonSerializableType
{
    /**
     * @var string $name Human-readable policy name.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description Description of the attack protection policy.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var int $priority Conflict resolution order. Lower number takes higher precedence. Must be unique per tenant.
     */
    #[JsonProperty('priority')]
    private int $priority;

    /**
     * @var AttackProtectionCaptchaPolicyMatch $match
     */
    #[JsonProperty('match')]
    private AttackProtectionCaptchaPolicyMatch $match;

    /**
     * @var AttackProtectionCaptchaPolicyActionInput $action
     */
    #[JsonProperty('action')]
    private AttackProtectionCaptchaPolicyActionInput $action;

    /**
     * @param array{
     *   name: string,
     *   priority: int,
     *   match: AttackProtectionCaptchaPolicyMatch,
     *   action: AttackProtectionCaptchaPolicyActionInput,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->priority = $values['priority'];
        $this->match = $values['match'];
        $this->action = $values['action'];
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
     * @return AttackProtectionCaptchaPolicyActionInput
     */
    public function getAction(): AttackProtectionCaptchaPolicyActionInput
    {
        return $this->action;
    }

    /**
     * @param AttackProtectionCaptchaPolicyActionInput $value
     */
    public function setAction(AttackProtectionCaptchaPolicyActionInput $value): self
    {
        $this->action = $value;
        $this->_setField('action');
        return $this;
    }
}
