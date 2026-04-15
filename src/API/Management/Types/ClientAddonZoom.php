<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Zoom SSO configuration.
 */
class ClientAddonZoom extends JsonSerializableType
{
    /**
     * @var ?string $account Zoom account name usually first segment of your Zoom URL, e.g. `https://acme-org.zoom.us` would be `acme-org`.
     */
    #[JsonProperty('account')]
    private ?string $account;

    /**
     * @param array{
     *   account?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->account = $values['account'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAccount(): ?string
    {
        return $this->account;
    }

    /**
     * @param ?string $value
     */
    public function setAccount(?string $value = null): self
    {
        $this->account = $value;
        $this->_setField('account');
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
