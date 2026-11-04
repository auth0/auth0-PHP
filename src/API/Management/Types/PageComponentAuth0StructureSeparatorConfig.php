<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0StructureSeparatorConfig extends JsonSerializableType
{
    /**
     * @var ?value-of<PageComponentAuth0StructureSeparatorVariantEnum> $variant
     */
    #[JsonProperty('variant')]
    private ?string $variant;

    /**
     * @var ?string $text Optional label centered within the separator line (ignored when variant is "none").
     */
    #[JsonProperty('text')]
    private ?string $text;

    /**
     * @param array{
     *   variant?: ?value-of<PageComponentAuth0StructureSeparatorVariantEnum>,
     *   text?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->variant = $values['variant'] ?? null;
        $this->text = $values['text'] ?? null;
    }

    /**
     * @return ?value-of<PageComponentAuth0StructureSeparatorVariantEnum>
     */
    public function getVariant(): ?string
    {
        return $this->variant;
    }

    /**
     * @param ?value-of<PageComponentAuth0StructureSeparatorVariantEnum> $value
     */
    public function setVariant(?string $value = null): self
    {
        $this->variant = $value;
        $this->_setField('variant');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param ?string $value
     */
    public function setText(?string $value = null): self
    {
        $this->text = $value;
        $this->_setField('text');
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
