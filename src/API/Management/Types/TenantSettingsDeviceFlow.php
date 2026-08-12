<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Device Flow configuration
 */
class TenantSettingsDeviceFlow extends JsonSerializableType
{
    /**
     * @var ?value-of<TenantSettingsDeviceFlowCharset> $charset
     */
    #[JsonProperty('charset')]
    private ?string $charset;

    /**
     * @var ?string $mask Mask used to format a generated User Code into a friendly, readable format.
     */
    #[JsonProperty('mask')]
    private ?string $mask;

    /**
     * @param array{
     *   charset?: ?value-of<TenantSettingsDeviceFlowCharset>,
     *   mask?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->charset = $values['charset'] ?? null;
        $this->mask = $values['mask'] ?? null;
    }

    /**
     * @return ?value-of<TenantSettingsDeviceFlowCharset>
     */
    public function getCharset(): ?string
    {
        return $this->charset;
    }

    /**
     * @param ?value-of<TenantSettingsDeviceFlowCharset> $value
     */
    public function setCharset(?string $value = null): self
    {
        $this->charset = $value;
        $this->_setField('charset');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMask(): ?string
    {
        return $this->mask;
    }

    /**
     * @param ?string $value
     */
    public function setMask(?string $value = null): self
    {
        $this->mask = $value;
        $this->_setField('mask');
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
