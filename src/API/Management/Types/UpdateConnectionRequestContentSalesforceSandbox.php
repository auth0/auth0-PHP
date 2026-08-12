<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=salesforce-sandbox
 */
class UpdateConnectionRequestContentSalesforceSandbox extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsSalesforce $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsSalesforce $options;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsSalesforce,
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
     * @return ?ConnectionOptionsSalesforce
     */
    public function getOptions(): ?ConnectionOptionsSalesforce
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsSalesforce $value
     */
    public function setOptions(?ConnectionOptionsSalesforce $value = null): self
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
