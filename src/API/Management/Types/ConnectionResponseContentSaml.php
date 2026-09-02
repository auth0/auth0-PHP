<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionPurposes;
use Auth0\SDK\API\Management\Traits\ConnectionResponseCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Response for connections with strategy=samlp
 */
class ConnectionResponseContentSaml extends JsonSerializableType
{
    use ConnectionPurposes;
    use ConnectionResponseCommon;

    /**
     * @var value-of<ConnectionResponseContentSamlStrategy> $strategy
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
     * @var ?string $provisioningTicketUrl
     */
    #[JsonProperty('provisioning_ticket_url')]
    private ?string $provisioningTicketUrl;

    /**
     * @var ?bool $showAsButton
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   strategy: value-of<ConnectionResponseContentSamlStrategy>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurpose,
     *   realms?: ?array<string>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   crossAppAccessResourceApp?: ?ConnectionCrossAppAccessResourceApp,
     *   options?: ?ConnectionOptionsSaml,
     *   provisioningTicketUrl?: ?string,
     *   showAsButton?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->authentication = $values['authentication'] ?? null;
        $this->connectedAccounts = $values['connectedAccounts'] ?? null;
        $this->id = $values['id'];
        $this->realms = $values['realms'] ?? null;
        $this->name = $values['name'];
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->strategy = $values['strategy'];
        $this->crossAppAccessResourceApp = $values['crossAppAccessResourceApp'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->provisioningTicketUrl = $values['provisioningTicketUrl'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
    }

    /**
     * @return value-of<ConnectionResponseContentSamlStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<ConnectionResponseContentSamlStrategy> $value
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
     * @return ?string
     */
    public function getProvisioningTicketUrl(): ?string
    {
        return $this->provisioningTicketUrl;
    }

    /**
     * @param ?string $value
     */
    public function setProvisioningTicketUrl(?string $value = null): self
    {
        $this->provisioningTicketUrl = $value;
        $this->_setField('provisioningTicketUrl');
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
