<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionPurposes;
use Auth0\SDK\API\Management\Traits\ConnectionResponseCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Response for connections with strategy=bitly
 */
class ConnectionResponseContentBitly extends JsonSerializableType
{
    use ConnectionPurposes;
    use ConnectionResponseCommon;

    /**
     * @var value-of<ConnectionResponseContentBitlyStrategy> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var ?ConnectionOptionsBitly $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsBitly $options;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   strategy: value-of<ConnectionResponseContentBitlyStrategy>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurpose,
     *   realms?: ?array<string>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsBitly,
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
     * @return value-of<ConnectionResponseContentBitlyStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<ConnectionResponseContentBitlyStrategy> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?ConnectionOptionsBitly
     */
    public function getOptions(): ?ConnectionOptionsBitly
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsBitly $value
     */
    public function setOptions(?ConnectionOptionsBitly $value = null): self
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
