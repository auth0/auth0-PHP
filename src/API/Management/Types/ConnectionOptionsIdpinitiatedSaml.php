<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for IdP-Initiated SAML Single Sign-On. When enabled, allows users to initiate login directly from their SAML identity provider without first visiting Auth0. The IdP must include the connection parameter in the post-back URL (Assertion Consumer Service URL).
 */
class ConnectionOptionsIdpinitiatedSaml extends JsonSerializableType
{
    /**
     * @var ?string $clientAuthorizequery The query string sent to the default application
     */
    #[JsonProperty('client_authorizequery')]
    private ?string $clientAuthorizequery;

    /**
     * @var ?string $clientId The client ID to use for IdP-initiated login requests.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?value-of<ConnectionOptionsIdpInitiatedClientProtocolEnumSaml> $clientProtocol
     */
    #[JsonProperty('client_protocol')]
    private ?string $clientProtocol;

    /**
     * @var ?bool $enabled When true, enables IdP-initiated login support for this SAML connection. Allows users to log in directly from the identity provider without first visiting Auth0.
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @param array{
     *   clientAuthorizequery?: ?string,
     *   clientId?: ?string,
     *   clientProtocol?: ?value-of<ConnectionOptionsIdpInitiatedClientProtocolEnumSaml>,
     *   enabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clientAuthorizequery = $values['clientAuthorizequery'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientProtocol = $values['clientProtocol'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getClientAuthorizequery(): ?string
    {
        return $this->clientAuthorizequery;
    }

    /**
     * @param ?string $value
     */
    public function setClientAuthorizequery(?string $value = null): self
    {
        $this->clientAuthorizequery = $value;
        $this->_setField('clientAuthorizequery');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionOptionsIdpInitiatedClientProtocolEnumSaml>
     */
    public function getClientProtocol(): ?string
    {
        return $this->clientProtocol;
    }

    /**
     * @param ?value-of<ConnectionOptionsIdpInitiatedClientProtocolEnumSaml> $value
     */
    public function setClientProtocol(?string $value = null): self
    {
        $this->clientProtocol = $value;
        $this->_setField('clientProtocol');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
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
