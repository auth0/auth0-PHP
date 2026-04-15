<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class BulkUpdateAculResponseContent extends JsonSerializableType
{
    /**
     * @var array<AculConfigsItem> $configs
     */
    #[JsonProperty('configs'), ArrayType([AculConfigsItem::class])]
    private array $configs;

    /**
     * @param array{
     *   configs: array<AculConfigsItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->configs = $values['configs'];
    }

    /**
     * @return array<AculConfigsItem>
     */
    public function getConfigs(): array
    {
        return $this->configs;
    }

    /**
     * @param array<AculConfigsItem> $value
     */
    public function setConfigs(array $value): self
    {
        $this->configs = $value;
        $this->_setField('configs');
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
