<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionPurposes;
use Auth0\SDK\API\Management\Traits\ConnectionResponseCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Response for connections with strategy=line
 */
class ConnectionResponseContentLine extends JsonSerializableType
{
    use ConnectionPurposes;
    use ConnectionResponseCommon;

    /**
     * @var value-of<ConnectionResponseContentLineStrategy> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var ?ConnectionOptionsLine $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsLine $options;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   strategy: value-of<ConnectionResponseContentLineStrategy>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurpose,
     *   realms?: ?array<string>,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsLine,
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
     * @return value-of<ConnectionResponseContentLineStrategy>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<ConnectionResponseContentLineStrategy> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?ConnectionOptionsLine
     */
    public function getOptions(): ?ConnectionOptionsLine
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsLine $value
     */
    public function setOptions(?ConnectionOptionsLine $value = null): self
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
