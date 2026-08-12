<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=instagram
 */
class UpdateConnectionRequestContentInstagram extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsInstagram $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsInstagram $options;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsInstagram,
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
     * @return ?ConnectionOptionsInstagram
     */
    public function getOptions(): ?ConnectionOptionsInstagram
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsInstagram $value
     */
    public function setOptions(?ConnectionOptionsInstagram $value = null): self
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
