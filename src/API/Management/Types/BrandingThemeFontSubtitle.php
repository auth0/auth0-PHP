<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Subtitle
 */
class BrandingThemeFontSubtitle extends JsonSerializableType
{
    /**
     * @var bool $bold Subtitle bold
     */
    #[JsonProperty('bold')]
    private bool $bold;

    /**
     * @var float $size Subtitle size
     */
    #[JsonProperty('size')]
    private float $size;

    /**
     * @param array{
     *   bold: bool,
     *   size: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->bold = $values['bold'];
        $this->size = $values['size'];
    }

    /**
     * @return bool
     */
    public function getBold(): bool
    {
        return $this->bold;
    }

    /**
     * @param bool $value
     */
    public function setBold(bool $value): self
    {
        $this->bold = $value;
        $this->_setField('bold');
        return $this;
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return $this->size;
    }

    /**
     * @param float $value
     */
    public function setSize(float $value): self
    {
        $this->size = $value;
        $this->_setField('size');
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
