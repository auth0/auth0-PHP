<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ScimTokenItem extends JsonSerializableType
{
    /**
     * @var ?string $tokenId The token's identifier
     */
    #[JsonProperty('token_id')]
    private ?string $tokenId;

    /**
     * @var ?array<string> $scopes The scopes of the scim token
     */
    #[JsonProperty('scopes'), ArrayType(['string'])]
    private ?array $scopes;

    /**
     * @var ?string $createdAt The token's created at timestamp
     */
    #[JsonProperty('created_at')]
    private ?string $createdAt;

    /**
     * @var ?string $validUntil The token's valid until timestamp
     */
    #[JsonProperty('valid_until')]
    private ?string $validUntil;

    /**
     * @var ?string $lastUsedAt The token's last used at timestamp
     */
    #[JsonProperty('last_used_at')]
    private ?string $lastUsedAt;

    /**
     * @param array{
     *   tokenId?: ?string,
     *   scopes?: ?array<string>,
     *   createdAt?: ?string,
     *   validUntil?: ?string,
     *   lastUsedAt?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->tokenId = $values['tokenId'] ?? null;
        $this->scopes = $values['scopes'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->validUntil = $values['validUntil'] ?? null;
        $this->lastUsedAt = $values['lastUsedAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getTokenId(): ?string
    {
        return $this->tokenId;
    }

    /**
     * @param ?string $value
     */
    public function setTokenId(?string $value = null): self
    {
        $this->tokenId = $value;
        $this->_setField('tokenId');
        return $this;
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
     * @return ?string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param ?string $value
     */
    public function setCreatedAt(?string $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getValidUntil(): ?string
    {
        return $this->validUntil;
    }

    /**
     * @param ?string $value
     */
    public function setValidUntil(?string $value = null): self
    {
        $this->validUntil = $value;
        $this->_setField('validUntil');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLastUsedAt(): ?string
    {
        return $this->lastUsedAt;
    }

    /**
     * @param ?string $value
     */
    public function setLastUsedAt(?string $value = null): self
    {
        $this->lastUsedAt = $value;
        $this->_setField('lastUsedAt');
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
