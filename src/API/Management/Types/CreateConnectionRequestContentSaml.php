<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\CreateConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Create a connection with strategy=samlp
 */
class CreateConnectionRequestContentSaml extends JsonSerializableType
{
    use CreateConnectionCommon;

    /**
     * @var value-of<CreateConnectionRequestContentSamlStrategy> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var ?ConnectionCrossAppAccessResourceApp $crossAppAccessResourceApp
     */
    #[JsonProperty('cross_app_access_resource_app')]
    private ?ConnectionCrossAppAccessResourceApp $crossAppAccessResourceApp;

    /**
     * @var ?ConnectionOptionsSaml $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsSaml $options;

    /**
     * @var ?bool $showAsButton
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @param array{
     *   name: string,
     *   strategy: value-of<CreateConnectionRequestContentSamlStrategy>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   crossAppAccessResourceApp?: ?ConnectionCrossAppAccessResourceApp,
     *   options?: ?ConnectionOptionsSaml,
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
        $this->crossAppAccessResourceApp = $values['crossAppAccessResourceApp'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
    }

    /**
     * @return value-of<CreateConnectionRequestContentSamlStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<CreateConnectionRequestContentSamlStrategy> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?ConnectionCrossAppAccessResourceApp
     */
    public function getCrossAppAccessResourceApp(): ?ConnectionCrossAppAccessResourceApp
    {
        return $this->crossAppAccessResourceApp;
    }

    /**
     * @param ?ConnectionCrossAppAccessResourceApp $value
     */
    public function setCrossAppAccessResourceApp(?ConnectionCrossAppAccessResourceApp $value = null): self
    {
        $this->crossAppAccessResourceApp = $value;
        $this->_setField('crossAppAccessResourceApp');
        return $this;
    }

    /**
     * @return ?ConnectionOptionsSaml
     */
    public function getOptions(): ?ConnectionOptionsSaml
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsSaml $value
     */
    public function setOptions(?ConnectionOptionsSaml $value = null): self
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
