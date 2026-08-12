<?php

namespace Auth0\SDK\API\Management\Rules\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateRuleRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $script Code to be executed when this rule runs.
     */
    #[JsonProperty('script')]
    private ?string $script;

    /**
     * @var ?string $name Name of this rule.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?float $order Order that this rule should execute in relative to other rules. Lower-valued rules execute first.
     */
    #[JsonProperty('order')]
    private ?float $order;

    /**
     * @var ?bool $enabled Whether the rule is enabled (true), or disabled (false).
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @param array{
     *   script?: ?string,
     *   name?: ?string,
     *   order?: ?float,
     *   enabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->script = $values['script'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->order = $values['order'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getScript(): ?string
    {
        return $this->script;
    }

    /**
     * @param ?string $value
     */
    public function setScript(?string $value = null): self
    {
        $this->script = $value;
        $this->_setField('script');
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
     * @return ?float
     */
    public function getOrder(): ?float
    {
        return $this->order;
    }

    /**
     * @param ?float $value
     */
    public function setOrder(?float $value = null): self
    {
        $this->order = $value;
        $this->_setField('order');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
        return $this;
    }
}
