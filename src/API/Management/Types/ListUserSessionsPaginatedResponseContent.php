<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListUserSessionsPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<SessionResponseContent> $sessions
     */
    #[JsonProperty('sessions'), ArrayType([SessionResponseContent::class])]
    private ?array $sessions;

    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   sessions?: ?array<SessionResponseContent>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->sessions = $values['sessions'] ?? null;
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return ?array<SessionResponseContent>
     */
    public function getSessions(): ?array
    {
        return $this->sessions;
    }

    /**
     * @param ?array<SessionResponseContent> $value
     */
    public function setSessions(?array $value = null): self
    {
        $this->sessions = $value;
        $this->_setField('sessions');
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
