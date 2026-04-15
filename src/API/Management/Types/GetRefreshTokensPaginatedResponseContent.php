<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetRefreshTokensPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<RefreshTokenResponseContent> $refreshTokens
     */
    #[JsonProperty('refresh_tokens'), ArrayType([RefreshTokenResponseContent::class])]
    private ?array $refreshTokens;

    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   refreshTokens?: ?array<RefreshTokenResponseContent>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->refreshTokens = $values['refreshTokens'] ?? null;
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return ?array<RefreshTokenResponseContent>
     */
    public function getRefreshTokens(): ?array
    {
        return $this->refreshTokens;
    }

    /**
     * @param ?array<RefreshTokenResponseContent> $value
     */
    public function setRefreshTokens(?array $value = null): self
    {
        $this->refreshTokens = $value;
        $this->_setField('refreshTokens');
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
