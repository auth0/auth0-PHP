<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\CreateConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Create a connection with strategy=thirtysevensignals
 */
class CreateConnectionRequestContentThirtySevenSignals extends JsonSerializableType
{
    use CreateConnectionCommon;

    /**
     * @var value-of<CreateConnectionRequestContentThirtySevenSignalsStrategy> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var ?ConnectionOptionsThirtySevenSignals $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsThirtySevenSignals $options;

    /**
     * @param array{
     *   name: string,
     *   strategy: value-of<CreateConnectionRequestContentThirtySevenSignalsStrategy>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsThirtySevenSignals,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->strategy = $values['strategy'];
        $this->options = $values['options'] ?? null;
    }

    /**
     * @return value-of<CreateConnectionRequestContentThirtySevenSignalsStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<CreateConnectionRequestContentThirtySevenSignalsStrategy> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?ConnectionOptionsThirtySevenSignals
     */
    public function getOptions(): ?ConnectionOptionsThirtySevenSignals
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsThirtySevenSignals $value
     */
    public function setOptions(?ConnectionOptionsThirtySevenSignals $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
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
