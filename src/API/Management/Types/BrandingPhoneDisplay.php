<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Phone number display settings.
 */
class BrandingPhoneDisplay extends JsonSerializableType
{
    /**
     * @var ?value-of<BrandingPhoneMaskingEnum> $masking
     */
    #[JsonProperty('masking')]
    private ?string $masking;

    /**
     * @var ?value-of<BrandingPhoneFormattingEnum> $formatting
     */
    #[JsonProperty('formatting')]
    private ?string $formatting;

    /**
     * @param array{
     *   masking?: ?value-of<BrandingPhoneMaskingEnum>,
     *   formatting?: ?value-of<BrandingPhoneFormattingEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->masking = $values['masking'] ?? null;
        $this->formatting = $values['formatting'] ?? null;
    }

    /**
     * @return ?value-of<BrandingPhoneMaskingEnum>
     */
    public function getMasking(): ?string
    {
        return $this->masking;
    }

    /**
     * @param ?value-of<BrandingPhoneMaskingEnum> $value
     */
    public function setMasking(?string $value = null): self
    {
        $this->masking = $value;
        $this->_setField('masking');
        return $this;
    }

    /**
     * @return ?value-of<BrandingPhoneFormattingEnum>
     */
    public function getFormatting(): ?string
    {
        return $this->formatting;
    }

    /**
     * @param ?value-of<BrandingPhoneFormattingEnum> $value
     */
    public function setFormatting(?string $value = null): self
    {
        $this->formatting = $value;
        $this->_setField('formatting');
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
