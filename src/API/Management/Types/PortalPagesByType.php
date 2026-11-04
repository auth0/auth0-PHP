<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class PortalPagesByType extends JsonSerializableType
{
    /**
     * @var ?string $default
     */
    #[JsonProperty('default')]
    private ?string $default;

    /**
     * @var ?array<PortalPage> $standard
     */
    #[JsonProperty('standard'), ArrayType([PortalPage::class])]
    private ?array $standard;

    /**
     * @param array{
     *   default?: ?string,
     *   standard?: ?array<PortalPage>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->default = $values['default'] ?? null;
        $this->standard = $values['standard'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getDefault(): ?string
    {
        return $this->default;
    }

    /**
     * @param ?string $value
     */
    public function setDefault(?string $value = null): self
    {
        $this->default = $value;
        $this->_setField('default');
        return $this;
    }

    /**
     * @return ?array<PortalPage>
     */
    public function getStandard(): ?array
    {
        return $this->standard;
    }

    /**
     * @param ?array<PortalPage> $value
     */
    public function setStandard(?array $value = null): self
    {
        $this->standard = $value;
        $this->_setField('standard');
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
