<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=twitter
 */
class UpdateConnectionRequestContentTwitter extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsTwitter $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsTwitter $options;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsTwitter,
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
     * @return ?ConnectionOptionsTwitter
     */
    public function getOptions(): ?ConnectionOptionsTwitter
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsTwitter $value
     */
    public function setOptions(?ConnectionOptionsTwitter $value = null): self
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
