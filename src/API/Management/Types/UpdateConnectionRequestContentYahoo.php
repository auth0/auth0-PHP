<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=yahoo
 */
class UpdateConnectionRequestContentYahoo extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsYahoo $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsYahoo $options;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsYahoo,
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
     * @return ?ConnectionOptionsYahoo
     */
    public function getOptions(): ?ConnectionOptionsYahoo
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsYahoo $value
     */
    public function setOptions(?ConnectionOptionsYahoo $value = null): self
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
