<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SidebarComponentAuth0ExternalLinkV2Config extends JsonSerializableType
{
    /**
     * @var string $label Text shown for the link.
     */
    #[JsonProperty('label')]
    private string $label;

    /**
     * @var string $href External URL to navigate to.
     */
    #[JsonProperty('href')]
    private string $href;

    /**
     * @var ?string $icon Name of the icon displayed next to the link label.
     */
    #[JsonProperty('icon')]
    private ?string $icon;

    /**
     * @param array{
     *   label: string,
     *   href: string,
     *   icon?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->label = $values['label'];
        $this->href = $values['href'];
        $this->icon = $values['icon'] ?? null;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $value
     */
    public function setLabel(string $value): self
    {
        $this->label = $value;
        $this->_setField('label');
        return $this;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $value
     */
    public function setHref(string $value): self
    {
        $this->href = $value;
        $this->_setField('href');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param ?string $value
     */
    public function setIcon(?string $value = null): self
    {
        $this->icon = $value;
        $this->_setField('icon');
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
