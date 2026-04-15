<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldCardsConfigOption extends JsonSerializableType
{
    /**
     * @var string $value
     */
    #[JsonProperty('value')]
    private string $value;

    /**
     * @var string $label
     */
    #[JsonProperty('label')]
    private string $label;

    /**
     * @var string $imageUrl
     */
    #[JsonProperty('image_url')]
    private string $imageUrl;

    /**
     * @param array{
     *   value: string,
     *   label: string,
     *   imageUrl: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->value = $values['value'];
        $this->label = $values['label'];
        $this->imageUrl = $values['imageUrl'];
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        $this->_setField('value');
        return $this;
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
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $value
     */
    public function setImageUrl(string $value): self
    {
        $this->imageUrl = $value;
        $this->_setField('imageUrl');
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
