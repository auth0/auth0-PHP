<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Checkpoint paginated list of client profiles.
 */
class ListClientProfilesPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var array<ClientProfile> $clientProfiles
     */
    #[JsonProperty('client_profiles'), ArrayType([ClientProfile::class])]
    private array $clientProfiles;

    /**
     * @param array{
     *   clientProfiles: array<ClientProfile>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->next = $values['next'] ?? null;
        $this->clientProfiles = $values['clientProfiles'];
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
     * @return array<ClientProfile>
     */
    public function getClientProfiles(): array
    {
        return $this->clientProfiles;
    }

    /**
     * @param array<ClientProfile> $value
     */
    public function setClientProfiles(array $value): self
    {
        $this->clientProfiles = $value;
        $this->_setField('clientProfiles');
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
