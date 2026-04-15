<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=oauth1
 */
class UpdateConnectionRequestContentOAuth1 extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsOAuth1 $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsOAuth1 $options;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsOAuth1,
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
     * @return ?ConnectionOptionsOAuth1
     */
    public function getOptions(): ?ConnectionOptionsOAuth1
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsOAuth1 $value
     */
    public function setOptions(?ConnectionOptionsOAuth1 $value = null): self
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
