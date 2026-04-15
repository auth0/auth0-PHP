<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormBlockImageConfig extends JsonSerializableType
{
    /**
     * @var string $src
     */
    #[JsonProperty('src')]
    private string $src;

    /**
     * @var ?value-of<FormBlockImageConfigPositionEnum> $position
     */
    #[JsonProperty('position')]
    private ?string $position;

    /**
     * @var ?float $height
     */
    #[JsonProperty('height')]
    private ?float $height;

    /**
     * @param array{
     *   src: string,
     *   position?: ?value-of<FormBlockImageConfigPositionEnum>,
     *   height?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->src = $values['src'];
        $this->position = $values['position'] ?? null;
        $this->height = $values['height'] ?? null;
    }

    /**
     * @return string
     */
    public function getSrc(): string
    {
        return $this->src;
    }

    /**
     * @param string $value
     */
    public function setSrc(string $value): self
    {
        $this->src = $value;
        $this->_setField('src');
        return $this;
    }

    /**
     * @return ?value-of<FormBlockImageConfigPositionEnum>
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param ?value-of<FormBlockImageConfigPositionEnum> $value
     */
    public function setPosition(?string $value = null): self
    {
        $this->position = $value;
        $this->_setField('position');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getHeight(): ?float
    {
        return $this->height;
    }

    /**
     * @param ?float $value
     */
    public function setHeight(?float $value = null): self
    {
        $this->height = $value;
        $this->_setField('height');
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
