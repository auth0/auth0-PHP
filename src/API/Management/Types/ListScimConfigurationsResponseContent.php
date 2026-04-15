<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListScimConfigurationsResponseContent extends JsonSerializableType
{
    /**
     * @var array<ScimConfiguration> $scimConfigurations List of SCIM configurations
     */
    #[JsonProperty('scim_configurations'), ArrayType([ScimConfiguration::class])]
    private array $scimConfigurations;

    /**
     * @var ?string $next The cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   scimConfigurations: array<ScimConfiguration>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->scimConfigurations = $values['scimConfigurations'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<ScimConfiguration>
     */
    public function getScimConfigurations(): array
    {
        return $this->scimConfigurations;
    }

    /**
     * @param array<ScimConfiguration> $value
     */
    public function setScimConfigurations(array $value): self
    {
        $this->scimConfigurations = $value;
        $this->_setField('scimConfigurations');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @param ?string $value
     */
    public function setNext(?string $value = null): self
    {
        $this->next = $value;
        $this->_setField('next');
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
