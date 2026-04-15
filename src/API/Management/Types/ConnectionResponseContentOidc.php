<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionResponseCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Response for connections with strategy=oidc
 */
class ConnectionResponseContentOidc extends JsonSerializableType
{
    use ConnectionResponseCommon;

    /**
     * @var value-of<ConnectionResponseContentOidcStrategy> $strategy
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
     *   id: string,
     *   name: string,
     *   strategy: value-of<ConnectionResponseContentOidcStrategy>,
     *   realms?: ?array<string>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurposeXaa,
     *   options?: ?ConnectionOptionsOidc,
     *   showAsButton?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->realms = $values['realms'] ?? null;
        $this->name = $values['name'];
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->strategy = $values['strategy'];
        $this->authentication = $values['authentication'] ?? null;
        $this->connectedAccounts = $values['connectedAccounts'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
    }

    /**
     * @return value-of<ConnectionResponseContentOidcStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<ConnectionResponseContentOidcStrategy> $value
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
