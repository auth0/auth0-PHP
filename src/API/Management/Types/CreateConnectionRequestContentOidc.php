<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\CreateConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Create a connection with strategy=oidc
 */
class CreateConnectionRequestContentOidc extends JsonSerializableType
{
    use CreateConnectionCommon;

    /**
     * @var value-of<CreateConnectionRequestContentOidcStrategy> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var ?ConnectionAuthenticationPurpose $authentication
     */
    #[JsonProperty('authentication')]
    private ?ConnectionAuthenticationPurpose $authentication;

    /**
     * @var ?ConnectionConnectedAccountsPurposeXaa $connectedAccounts
     */
    #[JsonProperty('connected_accounts')]
    private ?ConnectionConnectedAccountsPurposeXaa $connectedAccounts;

    /**
     * @var ?CrossAppAccessRequestingApp $crossAppAccessRequestingApp
     */
    #[JsonProperty('cross_app_access_requesting_app')]
    private ?CrossAppAccessRequestingApp $crossAppAccessRequestingApp;

    /**
     * @var ?ConnectionCrossAppAccessResourceApp $crossAppAccessResourceApp
     */
    #[JsonProperty('cross_app_access_resource_app')]
    private ?ConnectionCrossAppAccessResourceApp $crossAppAccessResourceApp;

    /**
     * @var ?ConnectionOptionsOidc $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsOidc $options;

    /**
     * @var ?bool $showAsButton
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @param array{
     *   name: string,
     *   strategy: value-of<CreateConnectionRequestContentOidcStrategy>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurposeXaa,
     *   crossAppAccessRequestingApp?: ?CrossAppAccessRequestingApp,
     *   crossAppAccessResourceApp?: ?ConnectionCrossAppAccessResourceApp,
     *   options?: ?ConnectionOptionsOidc,
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
        $this->authentication = $values['authentication'] ?? null;
        $this->connectedAccounts = $values['connectedAccounts'] ?? null;
        $this->crossAppAccessRequestingApp = $values['crossAppAccessRequestingApp'] ?? null;
        $this->crossAppAccessResourceApp = $values['crossAppAccessResourceApp'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
    }

    /**
     * @return value-of<CreateConnectionRequestContentOidcStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<CreateConnectionRequestContentOidcStrategy> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?ConnectionAuthenticationPurpose
     */
    public function getAuthentication(): ?ConnectionAuthenticationPurpose
    {
        return $this->authentication;
    }

    /**
     * @param ?ConnectionAuthenticationPurpose $value
     */
    public function setAuthentication(?ConnectionAuthenticationPurpose $value = null): self
    {
        $this->authentication = $value;
        $this->_setField('authentication');
        return $this;
    }

    /**
     * @return ?ConnectionConnectedAccountsPurposeXaa
     */
    public function getConnectedAccounts(): ?ConnectionConnectedAccountsPurposeXaa
    {
        return $this->connectedAccounts;
    }

    /**
     * @param ?ConnectionConnectedAccountsPurposeXaa $value
     */
    public function setConnectedAccounts(?ConnectionConnectedAccountsPurposeXaa $value = null): self
    {
        $this->connectedAccounts = $value;
        $this->_setField('connectedAccounts');
        return $this;
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
     * @return ?ConnectionOptionsOidc
     */
    public function getOptions(): ?ConnectionOptionsOidc
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsOidc $value
     */
    public function setOptions(?ConnectionOptionsOidc $value = null): self
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
