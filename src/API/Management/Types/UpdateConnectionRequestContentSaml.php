<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=samlp
 */
class UpdateConnectionRequestContentSaml extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsSaml $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsSaml $options;

    /**
     * @var ?ConnectionCrossAppAccessResourceApp $crossAppAccessResourceApp
     */
    #[JsonProperty('cross_app_access_resource_app')]
    private ?ConnectionCrossAppAccessResourceApp $crossAppAccessResourceApp;

    /**
     * @var ?bool $showAsButton
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsSaml,
     *   crossAppAccessResourceApp?: ?ConnectionCrossAppAccessResourceApp,
     *   showAsButton?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->displayName = $values['displayName'] ?? null;
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->crossAppAccessResourceApp = $values['crossAppAccessResourceApp'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
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
