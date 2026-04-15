<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ConnectionUpstreamAlias extends JsonSerializableType
{
    /**
     * @var ?value-of<ConnectionUpstreamAliasEnum> $alias
     */
    #[JsonProperty('alias')]
    private ?string $alias;

    /**
     * @param array{
     *   alias?: ?value-of<ConnectionUpstreamAliasEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->alias = $values['alias'] ?? null;
    }

    /**
     * @return ?value-of<ConnectionUpstreamAliasEnum>
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @param ?value-of<ConnectionUpstreamAliasEnum> $value
     */
    public function setAlias(?string $value = null): self
    {
        $this->alias = $value;
        $this->_setField('alias');
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
