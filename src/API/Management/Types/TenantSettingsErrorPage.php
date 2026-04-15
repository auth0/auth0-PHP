<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Error page customization.
 */
class TenantSettingsErrorPage extends JsonSerializableType
{
    /**
     * @var ?string $html Custom Error HTML (<a href='https://github.com/Shopify/liquid/wiki/Liquid-for-Designers'>Liquid syntax</a> is supported).
     */
    #[JsonProperty('html')]
    private ?string $html;

    /**
     * @var ?bool $showLogLink Whether to show the link to log as part of the default error page (true, default) or not to show the link (false).
     */
    #[JsonProperty('show_log_link')]
    private ?bool $showLogLink;

    /**
     * @var ?string $url URL to redirect to when an error occurs instead of showing the default error page.
     */
    #[JsonProperty('url')]
    private ?string $url;

    /**
     * @param array{
     *   html?: ?string,
     *   showLogLink?: ?bool,
     *   url?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->html = $values['html'] ?? null;
        $this->showLogLink = $values['showLogLink'] ?? null;
        $this->url = $values['url'] ?? null;
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
     * @return ?bool
     */
    public function getShowLogLink(): ?bool
    {
        return $this->showLogLink;
    }

    /**
     * @param ?bool $value
     */
    public function setShowLogLink(?bool $value = null): self
    {
        $this->showLogLink = $value;
        $this->_setField('showLogLink');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param ?string $value
     */
    public function setUrl(?string $value = null): self
    {
        $this->url = $value;
        $this->_setField('url');
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
