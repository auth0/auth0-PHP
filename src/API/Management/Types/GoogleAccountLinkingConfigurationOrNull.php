<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for Google account linking.
 */
class GoogleAccountLinkingConfigurationOrNull extends JsonSerializableType
{
    /**
     * @var ?bool $allowStreamlinedLinking Enables the Google streamlined account linking flow for this client.
     */
    #[JsonProperty('allow_streamlined_linking')]
    private ?bool $allowStreamlinedLinking;

    /**
     * @param array{
     *   allowStreamlinedLinking?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->allowStreamlinedLinking = $values['allowStreamlinedLinking'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getAllowStreamlinedLinking(): ?bool
    {
        return $this->allowStreamlinedLinking;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowStreamlinedLinking(?bool $value = null): self
    {
        $this->allowStreamlinedLinking = $value;
        $this->_setField('allowStreamlinedLinking');
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
