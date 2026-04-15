<?php

namespace Auth0\SDK\API\Management\NetworkAcls\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\NetworkAclRule;

class CreateNetworkAclRequestContent extends JsonSerializableType
{
    /**
     * @var string $description
     */
    #[JsonProperty('description')]
    private string $description;

    /**
     * @var bool $active Indicates whether or not this access control list is actively being used
     */
    #[JsonProperty('active')]
    private bool $active;

    /**
     * @var ?float $priority Indicates the order in which the ACL will be evaluated relative to other ACL rules.
     */
    #[JsonProperty('priority')]
    private ?float $priority;

    /**
     * @var NetworkAclRule $rule
     */
    #[JsonProperty('rule')]
    private NetworkAclRule $rule;

    /**
     * @param array{
     *   description: string,
     *   active: bool,
     *   rule: NetworkAclRule,
     *   priority?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->description = $values['description'];
        $this->active = $values['active'];
        $this->priority = $values['priority'] ?? null;
        $this->rule = $values['rule'];
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $value
     */
    public function setDescription(string $value): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $value
     */
    public function setActive(bool $value): self
    {
        $this->active = $value;
        $this->_setField('active');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getPriority(): ?float
    {
        return $this->priority;
    }

    /**
     * @param ?float $value
     */
    public function setPriority(?float $value = null): self
    {
        $this->priority = $value;
        $this->_setField('priority');
        return $this;
    }

    /**
     * @return NetworkAclRule
     */
    public function getRule(): NetworkAclRule
    {
        return $this->rule;
    }

    /**
     * @param NetworkAclRule $value
     */
    public function setRule(NetworkAclRule $value): self
    {
        $this->rule = $value;
        $this->_setField('rule');
        return $this;
    }
}
