<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class Rule extends JsonSerializableType
{
    /**
     * @var ?string $name Name of this rule.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $id ID of this rule.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?bool $enabled Whether the rule is enabled (true), or disabled (false).
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @var ?string $script Code to be executed when this rule runs.
     */
    #[JsonProperty('script')]
    private ?string $script;

    /**
     * @var ?float $order Order that this rule should execute in relative to other rules. Lower-valued rules execute first.
     */
    #[JsonProperty('order')]
    private ?float $order;

    /**
     * @var ?string $stage Execution stage of this rule. Can be `login_success`, `login_failure`, or `pre_authorize`.
     */
    #[JsonProperty('stage')]
    private ?string $stage;

    /**
     * @param array{
     *   name?: ?string,
     *   id?: ?string,
     *   enabled?: ?bool,
     *   script?: ?string,
     *   order?: ?float,
     *   stage?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->id = $values['id'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
        $this->script = $values['script'] ?? null;
        $this->order = $values['order'] ?? null;
        $this->stage = $values['stage'] ?? null;
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
     * @return ?string
     */
    public function getStage(): ?string
    {
        return $this->stage;
    }

    /**
     * @param ?string $value
     */
    public function setStage(?string $value = null): self
    {
        $this->stage = $value;
        $this->_setField('stage');
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
