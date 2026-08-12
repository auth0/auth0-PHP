<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=okta
 */
class UpdateConnectionRequestContentOkta extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?CrossAppAccessRequestingApp $crossAppAccessRequestingApp
     */
    #[JsonProperty('cross_app_access_requesting_app')]
    private ?CrossAppAccessRequestingApp $crossAppAccessRequestingApp;

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
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   crossAppAccessRequestingApp?: ?CrossAppAccessRequestingApp,
     *   options?: ?ConnectionOptionsOkta,
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
        $this->crossAppAccessRequestingApp = $values['crossAppAccessRequestingApp'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
    }

    /**
     * @return ?CrossAppAccessRequestingApp
     */
    public function getCrossAppAccessRequestingApp(): ?CrossAppAccessRequestingApp
    {
        return $this->crossAppAccessRequestingApp;
    }

    /**
     * @param ?CrossAppAccessRequestingApp $value
     */
    public function setCrossAppAccessRequestingApp(?CrossAppAccessRequestingApp $value = null): self
    {
        $this->crossAppAccessRequestingApp = $value;
        $this->_setField('crossAppAccessRequestingApp');
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
