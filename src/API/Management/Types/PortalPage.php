<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class PortalPage extends JsonSerializableType
{
    /**
     * @var string $title
     */
    #[JsonProperty('title')]
    private string $title;

    /**
     * @var string $slug
     */
    #[JsonProperty('slug')]
    private string $slug;

    /**
     * @var ?array<PageComponent> $components
     */
    #[JsonProperty('components'), ArrayType([PageComponent::class])]
    private ?array $components;

    /**
     * @param array{
     *   title: string,
     *   slug: string,
     *   components?: ?array<PageComponent>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->title = $values['title'];
        $this->slug = $values['slug'];
        $this->components = $values['components'] ?? null;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $value
     */
    public function setTitle(string $value): self
    {
        $this->title = $value;
        $this->_setField('title');
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $value
     */
    public function setSlug(string $value): self
    {
        $this->slug = $value;
        $this->_setField('slug');
        return $this;
    }

    /**
     * @return ?array<PageComponent>
     */
    public function getComponents(): ?array
    {
        return $this->components;
    }

    /**
     * @param ?array<PageComponent> $value
     */
    public function setComponents(?array $value = null): self
    {
        $this->components = $value;
        $this->_setField('components');
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
