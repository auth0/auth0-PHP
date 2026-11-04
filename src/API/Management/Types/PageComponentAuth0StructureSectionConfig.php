<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class PageComponentAuth0StructureSectionConfig extends JsonSerializableType
{
    /**
     * @var ?string $title Heading displayed at the top of the section.
     */
    #[JsonProperty('title')]
    private ?string $title;

    /**
     * @var ?string $description Optional description displayed below the title.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var value-of<PageComponentAuth0StructureSectionVariantEnum> $variant
     */
    #[JsonProperty('variant')]
    private string $variant;

    /**
     * @var array<PageComponentNoChildren> $children Components to render inside the section.
     */
    #[JsonProperty('children'), ArrayType([PageComponentNoChildren::class])]
    private array $children;

    /**
     * @param array{
     *   variant: value-of<PageComponentAuth0StructureSectionVariantEnum>,
     *   children: array<PageComponentNoChildren>,
     *   title?: ?string,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->title = $values['title'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->variant = $values['variant'];
        $this->children = $values['children'];
    }

    /**
     * @return ?string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param ?string $value
     */
    public function setTitle(?string $value = null): self
    {
        $this->title = $value;
        $this->_setField('title');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return value-of<PageComponentAuth0StructureSectionVariantEnum>
     */
    public function getVariant(): string
    {
        return $this->variant;
    }

    /**
     * @param value-of<PageComponentAuth0StructureSectionVariantEnum> $value
     */
    public function setVariant(string $value): self
    {
        $this->variant = $value;
        $this->_setField('variant');
        return $this;
    }

    /**
     * @return array<PageComponentNoChildren>
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param array<PageComponentNoChildren> $value
     */
    public function setChildren(array $value): self
    {
        $this->children = $value;
        $this->_setField('children');
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
