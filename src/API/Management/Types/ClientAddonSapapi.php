<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * SAP API addon configuration.
 */
class ClientAddonSapapi extends JsonSerializableType
{
    /**
     * @var ?string $clientid If activated in the OAuth 2.0 client configuration (transaction SOAUTH2) the SAML attribute client_id must be set and equal the client_id form parameter of the access token request.
     */
    #[JsonProperty('clientid')]
    private ?string $clientid;

    /**
     * @var ?string $usernameAttribute Name of the property in the user object that maps to a SAP username. e.g. `email`.
     */
    #[JsonProperty('usernameAttribute')]
    private ?string $usernameAttribute;

    /**
     * @var ?string $tokenEndpointUrl Your SAP OData server OAuth2 token endpoint URL.
     */
    #[JsonProperty('tokenEndpointUrl')]
    private ?string $tokenEndpointUrl;

    /**
     * @var ?string $scope Requested scope for SAP APIs.
     */
    #[JsonProperty('scope')]
    private ?string $scope;

    /**
     * @var ?string $servicePassword Service account password to use to authenticate API calls to the token endpoint.
     */
    #[JsonProperty('servicePassword')]
    private ?string $servicePassword;

    /**
     * @var ?string $nameIdentifierFormat NameID element of the Subject which can be used to express the user's identity. Defaults to `urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified`.
     */
    #[JsonProperty('nameIdentifierFormat')]
    private ?string $nameIdentifierFormat;

    /**
     * @param array{
     *   clientid?: ?string,
     *   usernameAttribute?: ?string,
     *   tokenEndpointUrl?: ?string,
     *   scope?: ?string,
     *   servicePassword?: ?string,
     *   nameIdentifierFormat?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clientid = $values['clientid'] ?? null;
        $this->usernameAttribute = $values['usernameAttribute'] ?? null;
        $this->tokenEndpointUrl = $values['tokenEndpointUrl'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->servicePassword = $values['servicePassword'] ?? null;
        $this->nameIdentifierFormat = $values['nameIdentifierFormat'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getClientid(): ?string
    {
        return $this->clientid;
    }

    /**
     * @param ?string $value
     */
    public function setClientid(?string $value = null): self
    {
        $this->clientid = $value;
        $this->_setField('clientid');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUsernameAttribute(): ?string
    {
        return $this->usernameAttribute;
    }

    /**
     * @param ?string $value
     */
    public function setUsernameAttribute(?string $value = null): self
    {
        $this->usernameAttribute = $value;
        $this->_setField('usernameAttribute');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTokenEndpointUrl(): ?string
    {
        return $this->tokenEndpointUrl;
    }

    /**
     * @param ?string $value
     */
    public function setTokenEndpointUrl(?string $value = null): self
    {
        $this->tokenEndpointUrl = $value;
        $this->_setField('tokenEndpointUrl');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param ?string $value
     */
    public function setScope(?string $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getServicePassword(): ?string
    {
        return $this->servicePassword;
    }

    /**
     * @param ?string $value
     */
    public function setServicePassword(?string $value = null): self
    {
        $this->servicePassword = $value;
        $this->_setField('servicePassword');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getNameIdentifierFormat(): ?string
    {
        return $this->nameIdentifierFormat;
    }

    /**
     * @param ?string $value
     */
    public function setNameIdentifierFormat(?string $value = null): self
    {
        $this->nameIdentifierFormat = $value;
        $this->_setField('nameIdentifierFormat');
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
