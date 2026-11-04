<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0MediaImageConfig extends JsonSerializableType
{
    /**
     * @var string $src URL of the image to display.
     */
    #[JsonProperty('src')]
    private string $src;

    /**
     * @var ?value-of<Position> $position
     */
    #[JsonProperty('position')]
    private ?string $position;

    /**
     * @var ?int $height Height of the image in pixels. Width scales automatically to preserve aspect ratio.
     */
    #[JsonProperty('height')]
    private ?int $height;

    /**
     * @param array{
     *   src: string,
     *   position?: ?value-of<Position>,
     *   height?: ?int,
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
     * @return ?value-of<Position>
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param ?value-of<Position> $value
     */
    public function setPosition(?string $value = null): self
    {
        $this->position = $value;
        $this->_setField('position');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param ?int $value
     */
    public function setHeight(?int $value = null): self
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
