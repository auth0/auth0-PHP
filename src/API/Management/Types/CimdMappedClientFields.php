<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Auth0 client fields mapped from the Client ID Metadata Document
 */
class CimdMappedClientFields extends JsonSerializableType
{
    /**
     * @var ?string $externalClientId The URL of the Client ID Metadata Document
     */
    #[JsonProperty('external_client_id')]
    private ?string $externalClientId;

    /**
     * @var ?string $name Client name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $appType Application type (e.g., web, native)
     */
    #[JsonProperty('app_type')]
    private ?string $appType;

    /**
     * @var ?array<string> $callbacks Callback URLs
     */
    #[JsonProperty('callbacks'), ArrayType(['string'])]
    private ?array $callbacks;

    /**
     * @var ?string $logoUri Logo URI
     */
    #[JsonProperty('logo_uri')]
    private ?string $logoUri;

    /**
     * @var ?string $description Human-readable brief description of this client presentable to the end-user
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?array<string> $grantTypes List of grant types
     */
    #[JsonProperty('grant_types'), ArrayType(['string'])]
    private ?array $grantTypes;

    /**
     * @var ?string $tokenEndpointAuthMethod Token endpoint authentication method
     */
    #[JsonProperty('token_endpoint_auth_method')]
    private ?string $tokenEndpointAuthMethod;

    /**
     * @var ?string $jwksUri URL for the JSON Web Key Set containing the public keys for private_key_jwt authentication
     */
    #[JsonProperty('jwks_uri')]
    private ?string $jwksUri;

    /**
     * @var ?CimdMappedClientAuthenticationMethods $clientAuthenticationMethods
     */
    #[JsonProperty('client_authentication_methods')]
    private ?CimdMappedClientAuthenticationMethods $clientAuthenticationMethods;

    /**
     * @param array{
     *   externalClientId?: ?string,
     *   name?: ?string,
     *   appType?: ?string,
     *   callbacks?: ?array<string>,
     *   logoUri?: ?string,
     *   description?: ?string,
     *   grantTypes?: ?array<string>,
     *   tokenEndpointAuthMethod?: ?string,
     *   jwksUri?: ?string,
     *   clientAuthenticationMethods?: ?CimdMappedClientAuthenticationMethods,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->externalClientId = $values['externalClientId'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->appType = $values['appType'] ?? null;
        $this->callbacks = $values['callbacks'] ?? null;
        $this->logoUri = $values['logoUri'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->grantTypes = $values['grantTypes'] ?? null;
        $this->tokenEndpointAuthMethod = $values['tokenEndpointAuthMethod'] ?? null;
        $this->jwksUri = $values['jwksUri'] ?? null;
        $this->clientAuthenticationMethods = $values['clientAuthenticationMethods'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getExternalClientId(): ?string
    {
        return $this->externalClientId;
    }

    /**
     * @param ?string $value
     */
    public function setExternalClientId(?string $value = null): self
    {
        $this->externalClientId = $value;
        $this->_setField('externalClientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAppType(): ?string
    {
        return $this->appType;
    }

    /**
     * @param ?string $value
     */
    public function setAppType(?string $value = null): self
    {
        $this->appType = $value;
        $this->_setField('appType');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getCallbacks(): ?array
    {
        return $this->callbacks;
    }

    /**
     * @param ?array<string> $value
     */
    public function setCallbacks(?array $value = null): self
    {
        $this->callbacks = $value;
        $this->_setField('callbacks');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLogoUri(): ?string
    {
        return $this->logoUri;
    }

    /**
     * @param ?string $value
     */
    public function setLogoUri(?string $value = null): self
    {
        $this->logoUri = $value;
        $this->_setField('logoUri');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getGrantTypes(): ?array
    {
        return $this->grantTypes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setGrantTypes(?array $value = null): self
    {
        $this->grantTypes = $value;
        $this->_setField('grantTypes');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTokenEndpointAuthMethod(): ?string
    {
        return $this->tokenEndpointAuthMethod;
    }

    /**
     * @param ?string $value
     */
    public function setTokenEndpointAuthMethod(?string $value = null): self
    {
        $this->tokenEndpointAuthMethod = $value;
        $this->_setField('tokenEndpointAuthMethod');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getJwksUri(): ?string
    {
        return $this->jwksUri;
    }

    /**
     * @param ?string $value
     */
    public function setJwksUri(?string $value = null): self
    {
        $this->jwksUri = $value;
        $this->_setField('jwksUri');
        return $this;
    }

    /**
     * @return ?CimdMappedClientAuthenticationMethods
     */
    public function getClientAuthenticationMethods(): ?CimdMappedClientAuthenticationMethods
    {
        return $this->clientAuthenticationMethods;
    }

    /**
     * @param ?CimdMappedClientAuthenticationMethods $value
     */
    public function setClientAuthenticationMethods(?CimdMappedClientAuthenticationMethods $value = null): self
    {
        $this->clientAuthenticationMethods = $value;
        $this->_setField('clientAuthenticationMethods');
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
