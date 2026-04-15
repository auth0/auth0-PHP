<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class RefreshTokenResourceServer extends JsonSerializableType
{
    /**
     * @var ?string $audience Resource server ID
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @var ?string $scopes List of scopes for the refresh token
     */
    #[JsonProperty('scopes')]
    private ?string $scopes;

    /**
     * @param array{
     *   audience?: ?string,
     *   scopes?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->audience = $values['audience'] ?? null;
        $this->scopes = $values['scopes'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAudience(): ?string
    {
        return $this->audience;
    }

    /**
     * @param ?string $value
     */
    public function setAudience(?string $value = null): self
    {
        $this->audience = $value;
        $this->_setField('audience');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScopes(): ?string
    {
        return $this->scopes;
    }

    /**
     * @param ?string $value
     */
    public function setScopes(?string $value = null): self
    {
        $this->scopes = $value;
        $this->_setField('scopes');
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
