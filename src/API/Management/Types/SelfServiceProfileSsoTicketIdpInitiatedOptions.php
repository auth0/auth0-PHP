<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Allows IdP-initiated login
 */
class SelfServiceProfileSsoTicketIdpInitiatedOptions extends JsonSerializableType
{
    /**
     * @var ?bool $enabled Enables IdP-initiated login for this connection
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @var ?string $clientId Default application <code>client_id</code> user is redirected to after validated SAML response
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?value-of<SelfServiceProfileSsoTicketIdpInitiatedClientProtocolEnum> $clientProtocol
     */
    #[JsonProperty('client_protocol')]
    private ?string $clientProtocol;

    /**
     * @var ?string $clientAuthorizequery Query string options to customize the behaviour for OpenID Connect when <code>idpinitiated.client_protocol</code> is <code>oauth2</code>. Allowed parameters: <code>redirect_uri</code>, <code>scope</code>, <code>response_type</code>. For example, <code>redirect_uri=https://jwt.io&scope=openid email&response_type=token</code>
     */
    #[JsonProperty('client_authorizequery')]
    private ?string $clientAuthorizequery;

    /**
     * @param array{
     *   enabled?: ?bool,
     *   clientId?: ?string,
     *   clientProtocol?: ?value-of<SelfServiceProfileSsoTicketIdpInitiatedClientProtocolEnum>,
     *   clientAuthorizequery?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabled = $values['enabled'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientProtocol = $values['clientProtocol'] ?? null;
        $this->clientAuthorizequery = $values['clientAuthorizequery'] ?? null;
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
     * @return ?value-of<SelfServiceProfileSsoTicketIdpInitiatedClientProtocolEnum>
     */
    public function getClientProtocol(): ?string
    {
        return $this->clientProtocol;
    }

    /**
     * @param ?value-of<SelfServiceProfileSsoTicketIdpInitiatedClientProtocolEnum> $value
     */
    public function setClientProtocol(?string $value = null): self
    {
        $this->clientProtocol = $value;
        $this->_setField('clientProtocol');
        return $this;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
