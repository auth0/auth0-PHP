<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListConnectionProfilesPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<ConnectionProfile> $connectionProfiles
     */
    #[JsonProperty('connection_profiles'), ArrayType([ConnectionProfile::class])]
    private ?array $connectionProfiles;

    /**
     * @param array{
     *   next?: ?string,
     *   connectionProfiles?: ?array<ConnectionProfile>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->connectionProfiles = $values['connectionProfiles'] ?? null;
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
     * @return ?array<ConnectionProfile>
     */
    public function getConnectionProfiles(): ?array
    {
        return $this->connectionProfiles;
    }

    /**
     * @param ?array<ConnectionProfile> $value
     */
    public function setConnectionProfiles(?array $value = null): self
    {
        $this->connectionProfiles = $value;
        $this->_setField('connectionProfiles');
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
