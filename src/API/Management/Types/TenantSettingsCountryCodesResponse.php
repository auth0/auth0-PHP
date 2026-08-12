<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Phone country code configuration for identifier input.
 */
class TenantSettingsCountryCodesResponse extends JsonSerializableType
{
    /**
     * @var ?array<string> $list Array of ISO 3166-1 alpha-2 country codes.
     */
    #[JsonProperty('list'), ArrayType(['string'])]
    private ?array $list;

    /**
     * @var ?value-of<TenantSettingsCountryCodesModeResponse> $mode
     */
    #[JsonProperty('mode')]
    private ?string $mode;

    /**
     * @param array{
     *   list?: ?array<string>,
     *   mode?: ?value-of<TenantSettingsCountryCodesModeResponse>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->list = $values['list'] ?? null;
        $this->mode = $values['mode'] ?? null;
    }

    /**
     * @return ?array<string>
     */
    public function getList(): ?array
    {
        return $this->list;
    }

    /**
     * @param ?array<string> $value
     */
    public function setList(?array $value = null): self
    {
        $this->list = $value;
        $this->_setField('list');
        return $this;
    }

    /**
     * @return ?value-of<TenantSettingsCountryCodesModeResponse>
     */
    public function getMode(): ?string
    {
        return $this->mode;
    }

    /**
     * @param ?value-of<TenantSettingsCountryCodesModeResponse> $value
     */
    public function setMode(?string $value = null): self
    {
        $this->mode = $value;
        $this->_setField('mode');
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
