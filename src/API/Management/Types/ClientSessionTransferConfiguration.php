<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Native to Web SSO Configuration
 */
class ClientSessionTransferConfiguration extends JsonSerializableType
{
    /**
     * @var ?bool $canCreateSessionTransferToken Indicates whether an app can issue a Session Transfer Token through Token Exchange. If set to 'false', the app will not be able to issue a Session Transfer Token. Usually configured in the native application. Default value is `false`.
     */
    #[JsonProperty('can_create_session_transfer_token')]
    private ?bool $canCreateSessionTransferToken;

    /**
     * @var ?bool $enforceCascadeRevocation Indicates whether revoking the parent Refresh Token that initiated a Native to Web flow and was used to issue a Session Transfer Token should trigger a cascade revocation affecting its dependent child entities. Usually configured in the native application. Default value is `true`, applicable only in Native to Web SSO context.
     */
    #[JsonProperty('enforce_cascade_revocation')]
    private ?bool $enforceCascadeRevocation;

    /**
     * @var ?array<value-of<ClientSessionTransferAllowedAuthenticationMethodsEnum>> $allowedAuthenticationMethods Indicates whether an app can create a session from a Session Transfer Token received via indicated methods. Can include `cookie` and/or `query`. Usually configured in the web application. Default value is an empty array [].
     */
    #[JsonProperty('allowed_authentication_methods'), ArrayType(['string'])]
    private ?array $allowedAuthenticationMethods;

    /**
     * @var ?value-of<ClientSessionTransferDeviceBindingEnum> $enforceDeviceBinding
     */
    #[JsonProperty('enforce_device_binding')]
    private ?string $enforceDeviceBinding;

    /**
     * @var ?bool $allowRefreshToken Indicates whether Refresh Tokens are allowed to be issued when authenticating with a Session Transfer Token. Usually configured in the web application. Default value is `false`.
     */
    #[JsonProperty('allow_refresh_token')]
    private ?bool $allowRefreshToken;

    /**
     * @var ?bool $enforceOnlineRefreshTokens Indicates whether Refresh Tokens created during a Native to Web session are tied to that session's lifetime. This determines if such refresh tokens should be automatically revoked when their corresponding sessions are. Usually configured in the web application. Default value is `true`, applicable only in Native to Web SSO context.
     */
    #[JsonProperty('enforce_online_refresh_tokens')]
    private ?bool $enforceOnlineRefreshTokens;

    /**
     * @var ?ClientSessionTransferDelegationConfiguration $delegation
     */
    #[JsonProperty('delegation')]
    private ?ClientSessionTransferDelegationConfiguration $delegation;

    /**
     * @param array{
     *   canCreateSessionTransferToken?: ?bool,
     *   enforceCascadeRevocation?: ?bool,
     *   allowedAuthenticationMethods?: ?array<value-of<ClientSessionTransferAllowedAuthenticationMethodsEnum>>,
     *   enforceDeviceBinding?: ?value-of<ClientSessionTransferDeviceBindingEnum>,
     *   allowRefreshToken?: ?bool,
     *   enforceOnlineRefreshTokens?: ?bool,
     *   delegation?: ?ClientSessionTransferDelegationConfiguration,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->canCreateSessionTransferToken = $values['canCreateSessionTransferToken'] ?? null;
        $this->enforceCascadeRevocation = $values['enforceCascadeRevocation'] ?? null;
        $this->allowedAuthenticationMethods = $values['allowedAuthenticationMethods'] ?? null;
        $this->enforceDeviceBinding = $values['enforceDeviceBinding'] ?? null;
        $this->allowRefreshToken = $values['allowRefreshToken'] ?? null;
        $this->enforceOnlineRefreshTokens = $values['enforceOnlineRefreshTokens'] ?? null;
        $this->delegation = $values['delegation'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getCanCreateSessionTransferToken(): ?bool
    {
        return $this->canCreateSessionTransferToken;
    }

    /**
     * @param ?bool $value
     */
    public function setCanCreateSessionTransferToken(?bool $value = null): self
    {
        $this->canCreateSessionTransferToken = $value;
        $this->_setField('canCreateSessionTransferToken');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnforceCascadeRevocation(): ?bool
    {
        return $this->enforceCascadeRevocation;
    }

    /**
     * @param ?bool $value
     */
    public function setEnforceCascadeRevocation(?bool $value = null): self
    {
        $this->enforceCascadeRevocation = $value;
        $this->_setField('enforceCascadeRevocation');
        return $this;
    }

    /**
     * @return ?array<value-of<ClientSessionTransferAllowedAuthenticationMethodsEnum>>
     */
    public function getAllowedAuthenticationMethods(): ?array
    {
        return $this->allowedAuthenticationMethods;
    }

    /**
     * @param ?array<value-of<ClientSessionTransferAllowedAuthenticationMethodsEnum>> $value
     */
    public function setAllowedAuthenticationMethods(?array $value = null): self
    {
        $this->allowedAuthenticationMethods = $value;
        $this->_setField('allowedAuthenticationMethods');
        return $this;
    }

    /**
     * @return ?value-of<ClientSessionTransferDeviceBindingEnum>
     */
    public function getEnforceDeviceBinding(): ?string
    {
        return $this->enforceDeviceBinding;
    }

    /**
     * @param ?value-of<ClientSessionTransferDeviceBindingEnum> $value
     */
    public function setEnforceDeviceBinding(?string $value = null): self
    {
        $this->enforceDeviceBinding = $value;
        $this->_setField('enforceDeviceBinding');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowRefreshToken(): ?bool
    {
        return $this->allowRefreshToken;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowRefreshToken(?bool $value = null): self
    {
        $this->allowRefreshToken = $value;
        $this->_setField('allowRefreshToken');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnforceOnlineRefreshTokens(): ?bool
    {
        return $this->enforceOnlineRefreshTokens;
    }

    /**
     * @param ?bool $value
     */
    public function setEnforceOnlineRefreshTokens(?bool $value = null): self
    {
        $this->enforceOnlineRefreshTokens = $value;
        $this->_setField('enforceOnlineRefreshTokens');
        return $this;
    }

    /**
     * @return ?ClientSessionTransferDelegationConfiguration
     */
    public function getDelegation(): ?ClientSessionTransferDelegationConfiguration
    {
        return $this->delegation;
    }

    /**
     * @param ?ClientSessionTransferDelegationConfiguration $value
     */
    public function setDelegation(?ClientSessionTransferDelegationConfiguration $value = null): self
    {
        $this->delegation = $value;
        $this->_setField('delegation');
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
