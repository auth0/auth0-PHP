<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListRefreshTokensPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<RefreshTokenResponseContent> $tokens
     */
    #[JsonProperty('tokens'), ArrayType([RefreshTokenResponseContent::class])]
    private ?array $tokens;

    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   tokens?: ?array<RefreshTokenResponseContent>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->tokens = $values['tokens'] ?? null;
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return ?array<RefreshTokenResponseContent>
     */
    public function getTokens(): ?array
    {
        return $this->tokens;
    }

    /**
     * @param ?array<RefreshTokenResponseContent> $value
     */
    public function setTokens(?array $value = null): self
    {
        $this->tokens = $value;
        $this->_setField('tokens');
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
