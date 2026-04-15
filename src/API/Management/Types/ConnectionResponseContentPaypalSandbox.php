<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionPurposes;
use Auth0\SDK\API\Management\Traits\ConnectionResponseCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Response for connections with strategy=paypal-sandbox
 */
class ConnectionResponseContentPaypalSandbox extends JsonSerializableType
{
    use ConnectionPurposes;
    use ConnectionResponseCommon;

    /**
     * @var value-of<ConnectionResponseContentPaypalSandboxStrategy> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var ?ConnectionOptionsPaypal $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsPaypal $options;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   strategy: value-of<ConnectionResponseContentPaypalSandboxStrategy>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurpose,
     *   realms?: ?array<string>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsPaypal,
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
    }

    /**
     * @return value-of<ConnectionResponseContentPaypalSandboxStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<ConnectionResponseContentPaypalSandboxStrategy> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?ConnectionOptionsPaypal
     */
    public function getOptions(): ?ConnectionOptionsPaypal
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsPaypal $value
     */
    public function setOptions(?ConnectionOptionsPaypal $value = null): self
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
