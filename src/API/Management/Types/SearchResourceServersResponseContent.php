<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class SearchResourceServersResponseContent extends JsonSerializableType
{
    /**
     * @var array<ResourceServerSearchResponse> $resourceServers Array of resource server objects matching the search criteria.
     */
    #[JsonProperty('resource_servers'), ArrayType([ResourceServerSearchResponse::class])]
    private array $resourceServers;

    /**
     * @var ?string $next Cursor for retrieving the next page of results. Omitted if there are no more results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   resourceServers: array<ResourceServerSearchResponse>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->resourceServers = $values['resourceServers'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<ResourceServerSearchResponse>
     */
    public function getResourceServers(): array
    {
        return $this->resourceServers;
    }

    /**
     * @param array<ResourceServerSearchResponse> $value
     */
    public function setResourceServers(array $value): self
    {
        $this->resourceServers = $value;
        $this->_setField('resourceServers');
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
