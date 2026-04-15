<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Guardian page customization.
 */
class TenantSettingsGuardianPage extends JsonSerializableType
{
    /**
     * @var ?bool $enabled Whether to use the custom Guardian HTML (true) or the default Auth0 page (false, default)
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @var ?string $html  Custom Guardian HTML (<a href='https://github.com/Shopify/liquid/wiki/Liquid-for-Designers'>Liquid syntax</a> is supported).
     */
    #[JsonProperty('html')]
    private ?string $html;

    /**
     * @param array{
     *   enabled?: ?bool,
     *   html?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabled = $values['enabled'] ?? null;
        $this->html = $values['html'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getHtml(): ?string
    {
        return $this->html;
    }

    /**
     * @param ?string $value
     */
    public function setHtml(?string $value = null): self
    {
        $this->html = $value;
        $this->_setField('html');
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
