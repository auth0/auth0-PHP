<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * OIDC support configuration for a client. Controls whether OIDC flows are allowed and which scopes the client may request.
 */
class ClientOidcSupportPost extends JsonSerializableType
{
    /**
     * @var bool $isAllowed
     */
    #[JsonProperty('is_allowed')]
    private bool $isAllowed;

    /**
     * @var ?bool $allowAllScopes
     */
    #[JsonProperty('allow_all_scopes')]
    private ?bool $allowAllScopes;

    /**
     * @var ?array<value-of<ClientOidcSupportAllowedScopesEnum>> $allowedScopes
     */
    #[JsonProperty('allowed_scopes'), ArrayType(['string'])]
    private ?array $allowedScopes;

    /**
     * @param array{
     *   isAllowed: bool,
     *   allowAllScopes?: ?bool,
     *   allowedScopes?: ?array<value-of<ClientOidcSupportAllowedScopesEnum>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isAllowed = $values['isAllowed'];
        $this->allowAllScopes = $values['allowAllScopes'] ?? null;
        $this->allowedScopes = $values['allowedScopes'] ?? null;
    }

    /**
     * @return bool
     */
    public function getIsAllowed(): bool
    {
        return $this->isAllowed;
    }

    /**
     * @param bool $value
     */
    public function setIsAllowed(bool $value): self
    {
        $this->isAllowed = $value;
        $this->_setField('isAllowed');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowAllScopes(): ?bool
    {
        return $this->allowAllScopes;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowAllScopes(?bool $value = null): self
    {
        $this->allowAllScopes = $value;
        $this->_setField('allowAllScopes');
        return $this;
    }

    /**
     * @return ?array<value-of<ClientOidcSupportAllowedScopesEnum>>
     */
    public function getAllowedScopes(): ?array
    {
        return $this->allowedScopes;
    }

    /**
     * @param ?array<value-of<ClientOidcSupportAllowedScopesEnum>> $value
     */
    public function setAllowedScopes(?array $value = null): self
    {
        $this->allowedScopes = $value;
        $this->_setField('allowedScopes');
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
