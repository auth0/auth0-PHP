<?php

namespace Auth0\SDK\API\Management\Connections\ScimConfiguration\Tokens\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateScimTokenRequestContent extends JsonSerializableType
{
    /**
     * @var ?array<string> $scopes The scopes of the scim token
     */
    #[JsonProperty('scopes'), ArrayType(['string'])]
    private ?array $scopes;

    /**
     * @var ?int $tokenLifetime Lifetime of the token in seconds. Must be greater than 900
     */
    #[JsonProperty('token_lifetime')]
    private ?int $tokenLifetime;

    /**
     * @param array{
     *   scopes?: ?array<string>,
     *   tokenLifetime?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->scopes = $values['scopes'] ?? null;
        $this->tokenLifetime = $values['tokenLifetime'] ?? null;
    }

    /**
     * @return ?array<string>
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setScopes(?array $value = null): self
    {
        $this->scopes = $value;
        $this->_setField('scopes');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTokenLifetime(): ?int
    {
        return $this->tokenLifetime;
    }

    /**
     * @param ?int $value
     */
    public function setTokenLifetime(?int $value = null): self
    {
        $this->tokenLifetime = $value;
        $this->_setField('tokenLifetime');
        return $this;
    }
}
