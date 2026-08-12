<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Google FedCM configuration for this client
 */
class FedCmLoginGoogle extends JsonSerializableType
{
    /**
     * @var ?bool $isEnabled When true, shows the Google FedCM prompt on New Universal Login for this client
     */
    #[JsonProperty('is_enabled')]
    private ?bool $isEnabled;

    /**
     * @param array{
     *   isEnabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->isEnabled = $values['isEnabled'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setIsEnabled(?bool $value = null): self
    {
        $this->isEnabled = $value;
        $this->_setField('isEnabled');
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
