<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Custom color settings.
 */
class BrandingColors extends JsonSerializableType
{
    /**
     * @var ?string $primary Accent color.
     */
    #[JsonProperty('primary')]
    private ?string $primary;

    /**
     * @var (
     *    string
     *   |array<string, mixed>
     *   |null
     * ) $pageBackground
     */
    #[JsonProperty('page_background'), Union(new Union('string', 'null'), new Union(['string' => 'mixed'], 'null'), 'null')]
    private string|array|null $pageBackground;

    /**
     * @param array{
     *   primary?: ?string,
     *   pageBackground?: (
     *    string
     *   |array<string, mixed>
     *   |null
     * ),
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->primary = $values['primary'] ?? null;
        $this->pageBackground = $values['pageBackground'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getPrimary(): ?string
    {
        return $this->primary;
    }

    /**
     * @param ?string $value
     */
    public function setPrimary(?string $value = null): self
    {
        $this->primary = $value;
        $this->_setField('primary');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |array<string, mixed>
     *   |null
     * )
     */
    public function getPageBackground(): string|array|null
    {
        return $this->pageBackground;
    }

    /**
     * @param (
     *    string
     *   |array<string, mixed>
     *   |null
     * ) $value
     */
    public function setPageBackground(string|array|null $value = null): self
    {
        $this->pageBackground = $value;
        $this->_setField('pageBackground');
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
