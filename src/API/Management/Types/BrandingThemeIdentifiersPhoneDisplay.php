<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Phone display
 */
class BrandingThemeIdentifiersPhoneDisplay extends JsonSerializableType
{
    /**
     * @var value-of<BrandingThemeIdentifiersPhoneDisplayFormattingEnum> $formatting
     */
    #[JsonProperty('formatting')]
    private string $formatting;

    /**
     * @var value-of<BrandingThemeIdentifiersPhoneDisplayMaskingEnum> $masking
     */
    #[JsonProperty('masking')]
    private string $masking;

    /**
     * @param array{
     *   formatting: value-of<BrandingThemeIdentifiersPhoneDisplayFormattingEnum>,
     *   masking: value-of<BrandingThemeIdentifiersPhoneDisplayMaskingEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->formatting = $values['formatting'];
        $this->masking = $values['masking'];
    }

    /**
     * @return value-of<BrandingThemeIdentifiersPhoneDisplayFormattingEnum>
     */
    public function getFormatting(): string
    {
        return $this->formatting;
    }

    /**
     * @param value-of<BrandingThemeIdentifiersPhoneDisplayFormattingEnum> $value
     */
    public function setFormatting(string $value): self
    {
        $this->formatting = $value;
        $this->_setField('formatting');
        return $this;
    }

    /**
     * @return value-of<BrandingThemeIdentifiersPhoneDisplayMaskingEnum>
     */
    public function getMasking(): string
    {
        return $this->masking;
    }

    /**
     * @param value-of<BrandingThemeIdentifiersPhoneDisplayMaskingEnum> $value
     */
    public function setMasking(string $value): self
    {
        $this->masking = $value;
        $this->_setField('masking');
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
