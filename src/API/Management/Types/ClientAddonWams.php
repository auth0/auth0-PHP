<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Windows Azure Mobile Services addon configuration.
 */
class ClientAddonWams extends JsonSerializableType
{
    /**
     * @var ?string $masterkey Your master key for Windows Azure Mobile Services.
     */
    #[JsonProperty('masterkey')]
    private ?string $masterkey;

    /**
     * @param array{
     *   masterkey?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->masterkey = $values['masterkey'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getMasterkey(): ?string
    {
        return $this->masterkey;
    }

    /**
     * @param ?string $value
     */
    public function setMasterkey(?string $value = null): self
    {
        $this->masterkey = $value;
        $this->_setField('masterkey');
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
