<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class OrganizationConnectionInformation extends JsonSerializableType
{
    /**
     * @var ?string $name The name of the enabled connection.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $strategy The strategy of the enabled connection.
     */
    #[JsonProperty('strategy')]
    private ?string $strategy;

    /**
     * @param array{
     *   name?: ?string,
     *   strategy?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->strategy = $values['strategy'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    /**
     * @param ?string $value
     */
    public function setStrategy(?string $value = null): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
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
