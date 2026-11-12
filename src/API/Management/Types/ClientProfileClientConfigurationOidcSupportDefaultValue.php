<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Controls whether matched clients can receive ID tokens and use the UserInfo endpoint, and which user profile information they can request through OIDC scopes.
 */
class ClientProfileClientConfigurationOidcSupportDefaultValue extends JsonSerializableType
{
    /**
     * @var bool $isAllowed Allows matched clients to use OIDC, including receiving ID tokens and calling the UserInfo endpoint.
     */
    #[JsonProperty('is_allowed')]
    private bool $isAllowed;

    /**
     * @var ?bool $allowAllScopes Allows matched clients to request all supported OIDC scopes. Mutually exclusive with allowed_scopes.
     */
    #[JsonProperty('allow_all_scopes')]
    private ?bool $allowAllScopes;

    /**
     * @var ?array<value-of<ClientProfileClientConfigurationOidcSupportAllowedScopesEnum>> $allowedScopes OIDC scopes matched clients may request (`profile`, `email`, `address`, and `phone`), which determine the user profile information they can access. Mutually exclusive with allow_all_scopes.
     */
    #[JsonProperty('allowed_scopes'), ArrayType(['string'])]
    private ?array $allowedScopes;

    /**
     * @param array{
     *   isAllowed: bool,
     *   allowAllScopes?: ?bool,
     *   allowedScopes?: ?array<value-of<ClientProfileClientConfigurationOidcSupportAllowedScopesEnum>>,
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
     * @return ?array<value-of<ClientProfileClientConfigurationOidcSupportAllowedScopesEnum>>
     */
    public function getAllowedScopes(): ?array
    {
        return $this->allowedScopes;
    }

    /**
     * @param ?array<value-of<ClientProfileClientConfigurationOidcSupportAllowedScopesEnum>> $value
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
