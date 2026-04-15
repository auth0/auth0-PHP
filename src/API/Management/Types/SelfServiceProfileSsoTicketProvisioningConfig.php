<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Configuration for the setup of Provisioning in the self-service flow.
 */
class SelfServiceProfileSsoTicketProvisioningConfig extends JsonSerializableType
{
    /**
     * @var ?array<value-of<SelfServiceProfileSsoTicketProvisioningScopeEnum>> $scopes The scopes of the SCIM tokens generated during the self-service flow.
     */
    #[JsonProperty('scopes'), ArrayType(['string'])]
    private ?array $scopes;

    /**
     * @var ?SelfServiceProfileSsoTicketGoogleWorkspaceConfig $googleWorkspace
     */
    #[JsonProperty('google_workspace')]
    private ?SelfServiceProfileSsoTicketGoogleWorkspaceConfig $googleWorkspace;

    /**
     * @var ?int $tokenLifetime Lifetime of the tokens in seconds. Must be greater than 900. If not provided, the tokens don't expire.
     */
    #[JsonProperty('token_lifetime')]
    private ?int $tokenLifetime;

    /**
     * @param array{
     *   scopes?: ?array<value-of<SelfServiceProfileSsoTicketProvisioningScopeEnum>>,
     *   googleWorkspace?: ?SelfServiceProfileSsoTicketGoogleWorkspaceConfig,
     *   tokenLifetime?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->scopes = $values['scopes'] ?? null;
        $this->googleWorkspace = $values['googleWorkspace'] ?? null;
        $this->tokenLifetime = $values['tokenLifetime'] ?? null;
    }

    /**
     * @return ?array<value-of<SelfServiceProfileSsoTicketProvisioningScopeEnum>>
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }

    /**
     * @param ?array<value-of<SelfServiceProfileSsoTicketProvisioningScopeEnum>> $value
     */
    public function setScopes(?array $value = null): self
    {
        $this->scopes = $value;
        $this->_setField('scopes');
        return $this;
    }

    /**
     * @return ?SelfServiceProfileSsoTicketGoogleWorkspaceConfig
     */
    public function getGoogleWorkspace(): ?SelfServiceProfileSsoTicketGoogleWorkspaceConfig
    {
        return $this->googleWorkspace;
    }

    /**
     * @param ?SelfServiceProfileSsoTicketGoogleWorkspaceConfig $value
     */
    public function setGoogleWorkspace(?SelfServiceProfileSsoTicketGoogleWorkspaceConfig $value = null): self
    {
        $this->googleWorkspace = $value;
        $this->_setField('googleWorkspace');
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
