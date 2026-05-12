<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Phone number display settings.
 */
class UpdateBrandingPhoneDisplay extends JsonSerializableType
{
    /**
     * @var value-of<UpdateBrandingPhoneMaskingEnum> $masking
     */
    #[JsonProperty('masking')]
    private string $masking;

    /**
     * @var value-of<UpdateBrandingPhoneFormattingEnum> $formatting
     */
    #[JsonProperty('formatting')]
    private string $formatting;

    /**
     * @param array{
     *   masking: value-of<UpdateBrandingPhoneMaskingEnum>,
     *   formatting: value-of<UpdateBrandingPhoneFormattingEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->masking = $values['masking'];
        $this->formatting = $values['formatting'];
    }

    /**
     * @return value-of<UpdateBrandingPhoneMaskingEnum>
     */
    public function getMasking(): string
    {
        return $this->masking;
    }

    /**
     * @param value-of<UpdateBrandingPhoneMaskingEnum> $value
     */
    public function setMasking(string $value): self
    {
        $this->masking = $value;
        $this->_setField('masking');
        return $this;
    }

    /**
     * @return value-of<UpdateBrandingPhoneFormattingEnum>
     */
    public function getFormatting(): string
    {
        return $this->formatting;
    }

    /**
     * @param value-of<UpdateBrandingPhoneFormattingEnum> $value
     */
    public function setFormatting(string $value): self
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
