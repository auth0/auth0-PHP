<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionPurposes;
use Auth0\SDK\API\Management\Traits\ConnectionResponseCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Response for connections with strategy=sharepoint
 */
class ConnectionResponseContentSharepoint extends JsonSerializableType
{
    use ConnectionPurposes;
    use ConnectionResponseCommon;

    /**
     * @var value-of<ConnectionResponseContentSharepointStrategy> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var ?ConnectionOptionsSharepoint $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsSharepoint $options;

    /**
     * @var ?bool $showAsButton
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   strategy: value-of<ConnectionResponseContentSharepointStrategy>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurpose,
     *   realms?: ?array<string>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsSharepoint,
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
        $this->options = $values['options'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
    }

    /**
     * @return value-of<ConnectionResponseContentSharepointStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<ConnectionResponseContentSharepointStrategy> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?ConnectionOptionsSharepoint
     */
    public function getOptions(): ?ConnectionOptionsSharepoint
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsSharepoint $value
     */
    public function setOptions(?ConnectionOptionsSharepoint $value = null): self
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
