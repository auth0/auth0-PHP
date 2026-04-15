<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\CreateConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Create a connection with strategy=okta
 */
class CreateConnectionRequestContentOkta extends JsonSerializableType
{
    use CreateConnectionCommon;

    /**
     * @var value-of<CreateConnectionRequestContentOktaStrategy> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var ?ConnectionOptionsOkta $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsOkta $options;

    /**
     * @var ?bool $showAsButton
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @param array{
     *   name: string,
     *   strategy: value-of<CreateConnectionRequestContentOktaStrategy>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsOkta,
     *   showAsButton?: ?bool,
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
        $this->showAsButton = $values['showAsButton'] ?? null;
    }

    /**
     * @return value-of<CreateConnectionRequestContentOktaStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<CreateConnectionRequestContentOktaStrategy> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?ConnectionOptionsOkta
     */
    public function getOptions(): ?ConnectionOptionsOkta
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsOkta $value
     */
    public function setOptions(?ConnectionOptionsOkta $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getShowAsButton(): ?bool
    {
        return $this->showAsButton;
    }

    /**
     * @param ?bool $value
     */
    public function setShowAsButton(?bool $value = null): self
    {
        $this->showAsButton = $value;
        $this->_setField('showAsButton');
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
