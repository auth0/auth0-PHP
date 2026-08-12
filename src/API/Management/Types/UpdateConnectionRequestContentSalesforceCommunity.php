<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=salesforce-community
 */
class UpdateConnectionRequestContentSalesforceCommunity extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsSalesforceCommunity $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsSalesforceCommunity $options;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsSalesforceCommunity,
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
    }

    /**
     * @return ?ConnectionOptionsSalesforceCommunity
     */
    public function getOptions(): ?ConnectionOptionsSalesforceCommunity
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsSalesforceCommunity $value
     */
    public function setOptions(?ConnectionOptionsSalesforceCommunity $value = null): self
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
