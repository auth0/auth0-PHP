<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * OpenID Connect Provider Metadata as per https://openid.net/specs/openid-connect-discovery-1_0.html#ProviderMetadata
 */
class ConnectionOptionsOidcMetadata extends JsonSerializableType
{
    /**
     * @var ?array<string> $acrValuesSupported
     */
    #[JsonProperty('acr_values_supported'), ArrayType(['string'])]
    private ?array $acrValuesSupported;

    /**
     * @var string $authorizationEndpoint
     */
    #[JsonProperty('authorization_endpoint')]
    private string $authorizationEndpoint;

    /**
     * @var ?array<string> $claimTypesSupported
     */
    #[JsonProperty('claim_types_supported'), ArrayType(['string'])]
    private ?array $claimTypesSupported;

    /**
     * @var ?array<string> $claimsLocalesSupported
     */
    #[JsonProperty('claims_locales_supported'), ArrayType(['string'])]
    private ?array $claimsLocalesSupported;

    /**
     * @var ?bool $claimsParameterSupported
     */
    #[JsonProperty('claims_parameter_supported')]
    private ?bool $claimsParameterSupported;

    /**
     * @var ?array<string> $claimsSupported
     */
    #[JsonProperty('claims_supported'), ArrayType(['string'])]
    private ?array $claimsSupported;

    /**
     * @var ?array<string> $displayValuesSupported
     */
    #[JsonProperty('display_values_supported'), ArrayType(['string'])]
    private ?array $displayValuesSupported;

    /**
     * @var ?array<string> $dpopSigningAlgValuesSupported
     */
    #[JsonProperty('dpop_signing_alg_values_supported'), ArrayType(['string'])]
    private ?array $dpopSigningAlgValuesSupported;

    /**
     * @var ?string $endSessionEndpoint
     */
    #[JsonProperty('end_session_endpoint')]
    private ?string $endSessionEndpoint;

    /**
     * @var ?array<string> $grantTypesSupported
     */
    #[JsonProperty('grant_types_supported'), ArrayType(['string'])]
    private ?array $grantTypesSupported;

    /**
     * @var ?array<string> $idTokenEncryptionAlgValuesSupported
     */
    #[JsonProperty('id_token_encryption_alg_values_supported'), ArrayType(['string'])]
    private ?array $idTokenEncryptionAlgValuesSupported;

    /**
     * @var ?array<string> $idTokenEncryptionEncValuesSupported
     */
    #[JsonProperty('id_token_encryption_enc_values_supported'), ArrayType(['string'])]
    private ?array $idTokenEncryptionEncValuesSupported;

    /**
     * @var array<string> $idTokenSigningAlgValuesSupported
     */
    #[JsonProperty('id_token_signing_alg_values_supported'), ArrayType(['string'])]
    private array $idTokenSigningAlgValuesSupported;

    /**
     * @var string $issuer
     */
    #[JsonProperty('issuer')]
    private string $issuer;

    /**
     * @var string $jwksUri
     */
    #[JsonProperty('jwks_uri')]
    private string $jwksUri;

    /**
     * @var ?string $opPolicyUri
     */
    #[JsonProperty('op_policy_uri')]
    private ?string $opPolicyUri;

    /**
     * @var ?string $opTosUri
     */
    #[JsonProperty('op_tos_uri')]
    private ?string $opTosUri;

    /**
     * @var ?string $registrationEndpoint
     */
    #[JsonProperty('registration_endpoint')]
    private ?string $registrationEndpoint;

    /**
     * @var ?array<string> $requestObjectEncryptionAlgValuesSupported
     */
    #[JsonProperty('request_object_encryption_alg_values_supported'), ArrayType(['string'])]
    private ?array $requestObjectEncryptionAlgValuesSupported;

    /**
     * @var ?array<string> $requestObjectEncryptionEncValuesSupported
     */
    #[JsonProperty('request_object_encryption_enc_values_supported'), ArrayType(['string'])]
    private ?array $requestObjectEncryptionEncValuesSupported;

    /**
     * @var ?array<string> $requestObjectSigningAlgValuesSupported
     */
    #[JsonProperty('request_object_signing_alg_values_supported'), ArrayType(['string'])]
    private ?array $requestObjectSigningAlgValuesSupported;

    /**
     * @var ?bool $requestParameterSupported
     */
    #[JsonProperty('request_parameter_supported')]
    private ?bool $requestParameterSupported;

    /**
     * @var ?bool $requestUriParameterSupported
     */
    #[JsonProperty('request_uri_parameter_supported')]
    private ?bool $requestUriParameterSupported;

    /**
     * @var ?bool $requireRequestUriRegistration
     */
    #[JsonProperty('require_request_uri_registration')]
    private ?bool $requireRequestUriRegistration;

    /**
     * @var ?array<string> $responseModesSupported
     */
    #[JsonProperty('response_modes_supported'), ArrayType(['string'])]
    private ?array $responseModesSupported;

    /**
     * @var ?array<string> $responseTypesSupported
     */
    #[JsonProperty('response_types_supported'), ArrayType(['string'])]
    private ?array $responseTypesSupported;

    /**
     * @var ?array<string> $scopesSupported
     */
    #[JsonProperty('scopes_supported'), ArrayType(['string'])]
    private ?array $scopesSupported;

    /**
     * @var ?string $serviceDocumentation
     */
    #[JsonProperty('service_documentation')]
    private ?string $serviceDocumentation;

    /**
     * @var ?array<string> $subjectTypesSupported
     */
    #[JsonProperty('subject_types_supported'), ArrayType(['string'])]
    private ?array $subjectTypesSupported;

    /**
     * @var ?string $tokenEndpoint
     */
    #[JsonProperty('token_endpoint')]
    private ?string $tokenEndpoint;

    /**
     * @var ?array<string> $tokenEndpointAuthMethodsSupported
     */
    #[JsonProperty('token_endpoint_auth_methods_supported'), ArrayType(['string'])]
    private ?array $tokenEndpointAuthMethodsSupported;

    /**
     * @var ?array<string> $tokenEndpointAuthSigningAlgValuesSupported
     */
    #[JsonProperty('token_endpoint_auth_signing_alg_values_supported'), ArrayType(['string'])]
    private ?array $tokenEndpointAuthSigningAlgValuesSupported;

    /**
     * @var ?array<string> $uiLocalesSupported
     */
    #[JsonProperty('ui_locales_supported'), ArrayType(['string'])]
    private ?array $uiLocalesSupported;

    /**
     * @var ?array<string> $userinfoEncryptionAlgValuesSupported
     */
    #[JsonProperty('userinfo_encryption_alg_values_supported'), ArrayType(['string'])]
    private ?array $userinfoEncryptionAlgValuesSupported;

    /**
     * @var ?array<string> $userinfoEncryptionEncValuesSupported
     */
    #[JsonProperty('userinfo_encryption_enc_values_supported'), ArrayType(['string'])]
    private ?array $userinfoEncryptionEncValuesSupported;

    /**
     * @var ?string $userinfoEndpoint
     */
    #[JsonProperty('userinfo_endpoint')]
    private ?string $userinfoEndpoint;

    /**
     * @var ?array<string> $userinfoSigningAlgValuesSupported
     */
    #[JsonProperty('userinfo_signing_alg_values_supported'), ArrayType(['string'])]
    private ?array $userinfoSigningAlgValuesSupported;

    /**
     * @param array{
     *   authorizationEndpoint: string,
     *   idTokenSigningAlgValuesSupported: array<string>,
     *   issuer: string,
     *   jwksUri: string,
     *   acrValuesSupported?: ?array<string>,
     *   claimTypesSupported?: ?array<string>,
     *   claimsLocalesSupported?: ?array<string>,
     *   claimsParameterSupported?: ?bool,
     *   claimsSupported?: ?array<string>,
     *   displayValuesSupported?: ?array<string>,
     *   dpopSigningAlgValuesSupported?: ?array<string>,
     *   endSessionEndpoint?: ?string,
     *   grantTypesSupported?: ?array<string>,
     *   idTokenEncryptionAlgValuesSupported?: ?array<string>,
     *   idTokenEncryptionEncValuesSupported?: ?array<string>,
     *   opPolicyUri?: ?string,
     *   opTosUri?: ?string,
     *   registrationEndpoint?: ?string,
     *   requestObjectEncryptionAlgValuesSupported?: ?array<string>,
     *   requestObjectEncryptionEncValuesSupported?: ?array<string>,
     *   requestObjectSigningAlgValuesSupported?: ?array<string>,
     *   requestParameterSupported?: ?bool,
     *   requestUriParameterSupported?: ?bool,
     *   requireRequestUriRegistration?: ?bool,
     *   responseModesSupported?: ?array<string>,
     *   responseTypesSupported?: ?array<string>,
     *   scopesSupported?: ?array<string>,
     *   serviceDocumentation?: ?string,
     *   subjectTypesSupported?: ?array<string>,
     *   tokenEndpoint?: ?string,
     *   tokenEndpointAuthMethodsSupported?: ?array<string>,
     *   tokenEndpointAuthSigningAlgValuesSupported?: ?array<string>,
     *   uiLocalesSupported?: ?array<string>,
     *   userinfoEncryptionAlgValuesSupported?: ?array<string>,
     *   userinfoEncryptionEncValuesSupported?: ?array<string>,
     *   userinfoEndpoint?: ?string,
     *   userinfoSigningAlgValuesSupported?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->acrValuesSupported = $values['acrValuesSupported'] ?? null;
        $this->authorizationEndpoint = $values['authorizationEndpoint'];
        $this->claimTypesSupported = $values['claimTypesSupported'] ?? null;
        $this->claimsLocalesSupported = $values['claimsLocalesSupported'] ?? null;
        $this->claimsParameterSupported = $values['claimsParameterSupported'] ?? null;
        $this->claimsSupported = $values['claimsSupported'] ?? null;
        $this->displayValuesSupported = $values['displayValuesSupported'] ?? null;
        $this->dpopSigningAlgValuesSupported = $values['dpopSigningAlgValuesSupported'] ?? null;
        $this->endSessionEndpoint = $values['endSessionEndpoint'] ?? null;
        $this->grantTypesSupported = $values['grantTypesSupported'] ?? null;
        $this->idTokenEncryptionAlgValuesSupported = $values['idTokenEncryptionAlgValuesSupported'] ?? null;
        $this->idTokenEncryptionEncValuesSupported = $values['idTokenEncryptionEncValuesSupported'] ?? null;
        $this->idTokenSigningAlgValuesSupported = $values['idTokenSigningAlgValuesSupported'];
        $this->issuer = $values['issuer'];
        $this->jwksUri = $values['jwksUri'];
        $this->opPolicyUri = $values['opPolicyUri'] ?? null;
        $this->opTosUri = $values['opTosUri'] ?? null;
        $this->registrationEndpoint = $values['registrationEndpoint'] ?? null;
        $this->requestObjectEncryptionAlgValuesSupported = $values['requestObjectEncryptionAlgValuesSupported'] ?? null;
        $this->requestObjectEncryptionEncValuesSupported = $values['requestObjectEncryptionEncValuesSupported'] ?? null;
        $this->requestObjectSigningAlgValuesSupported = $values['requestObjectSigningAlgValuesSupported'] ?? null;
        $this->requestParameterSupported = $values['requestParameterSupported'] ?? null;
        $this->requestUriParameterSupported = $values['requestUriParameterSupported'] ?? null;
        $this->requireRequestUriRegistration = $values['requireRequestUriRegistration'] ?? null;
        $this->responseModesSupported = $values['responseModesSupported'] ?? null;
        $this->responseTypesSupported = $values['responseTypesSupported'] ?? null;
        $this->scopesSupported = $values['scopesSupported'] ?? null;
        $this->serviceDocumentation = $values['serviceDocumentation'] ?? null;
        $this->subjectTypesSupported = $values['subjectTypesSupported'] ?? null;
        $this->tokenEndpoint = $values['tokenEndpoint'] ?? null;
        $this->tokenEndpointAuthMethodsSupported = $values['tokenEndpointAuthMethodsSupported'] ?? null;
        $this->tokenEndpointAuthSigningAlgValuesSupported = $values['tokenEndpointAuthSigningAlgValuesSupported'] ?? null;
        $this->uiLocalesSupported = $values['uiLocalesSupported'] ?? null;
        $this->userinfoEncryptionAlgValuesSupported = $values['userinfoEncryptionAlgValuesSupported'] ?? null;
        $this->userinfoEncryptionEncValuesSupported = $values['userinfoEncryptionEncValuesSupported'] ?? null;
        $this->userinfoEndpoint = $values['userinfoEndpoint'] ?? null;
        $this->userinfoSigningAlgValuesSupported = $values['userinfoSigningAlgValuesSupported'] ?? null;
    }

    /**
     * @return ?array<string>
     */
    public function getAcrValuesSupported(): ?array
    {
        return $this->acrValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAcrValuesSupported(?array $value = null): self
    {
        $this->acrValuesSupported = $value;
        $this->_setField('acrValuesSupported');
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationEndpoint(): string
    {
        return $this->authorizationEndpoint;
    }

    /**
     * @param string $value
     */
    public function setAuthorizationEndpoint(string $value): self
    {
        $this->authorizationEndpoint = $value;
        $this->_setField('authorizationEndpoint');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getClaimTypesSupported(): ?array
    {
        return $this->claimTypesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setClaimTypesSupported(?array $value = null): self
    {
        $this->claimTypesSupported = $value;
        $this->_setField('claimTypesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getClaimsLocalesSupported(): ?array
    {
        return $this->claimsLocalesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setClaimsLocalesSupported(?array $value = null): self
    {
        $this->claimsLocalesSupported = $value;
        $this->_setField('claimsLocalesSupported');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getClaimsParameterSupported(): ?bool
    {
        return $this->claimsParameterSupported;
    }

    /**
     * @param ?bool $value
     */
    public function setClaimsParameterSupported(?bool $value = null): self
    {
        $this->claimsParameterSupported = $value;
        $this->_setField('claimsParameterSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getClaimsSupported(): ?array
    {
        return $this->claimsSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setClaimsSupported(?array $value = null): self
    {
        $this->claimsSupported = $value;
        $this->_setField('claimsSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getDisplayValuesSupported(): ?array
    {
        return $this->displayValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setDisplayValuesSupported(?array $value = null): self
    {
        $this->displayValuesSupported = $value;
        $this->_setField('displayValuesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getDpopSigningAlgValuesSupported(): ?array
    {
        return $this->dpopSigningAlgValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setDpopSigningAlgValuesSupported(?array $value = null): self
    {
        $this->dpopSigningAlgValuesSupported = $value;
        $this->_setField('dpopSigningAlgValuesSupported');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEndSessionEndpoint(): ?string
    {
        return $this->endSessionEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setEndSessionEndpoint(?string $value = null): self
    {
        $this->endSessionEndpoint = $value;
        $this->_setField('endSessionEndpoint');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getGrantTypesSupported(): ?array
    {
        return $this->grantTypesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setGrantTypesSupported(?array $value = null): self
    {
        $this->grantTypesSupported = $value;
        $this->_setField('grantTypesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getIdTokenEncryptionAlgValuesSupported(): ?array
    {
        return $this->idTokenEncryptionAlgValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setIdTokenEncryptionAlgValuesSupported(?array $value = null): self
    {
        $this->idTokenEncryptionAlgValuesSupported = $value;
        $this->_setField('idTokenEncryptionAlgValuesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getIdTokenEncryptionEncValuesSupported(): ?array
    {
        return $this->idTokenEncryptionEncValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setIdTokenEncryptionEncValuesSupported(?array $value = null): self
    {
        $this->idTokenEncryptionEncValuesSupported = $value;
        $this->_setField('idTokenEncryptionEncValuesSupported');
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getIdTokenSigningAlgValuesSupported(): array
    {
        return $this->idTokenSigningAlgValuesSupported;
    }

    /**
     * @param array<string> $value
     */
    public function setIdTokenSigningAlgValuesSupported(array $value): self
    {
        $this->idTokenSigningAlgValuesSupported = $value;
        $this->_setField('idTokenSigningAlgValuesSupported');
        return $this;
    }

    /**
     * @return string
     */
    public function getIssuer(): string
    {
        return $this->issuer;
    }

    /**
     * @param string $value
     */
    public function setIssuer(string $value): self
    {
        $this->issuer = $value;
        $this->_setField('issuer');
        return $this;
    }

    /**
     * @return string
     */
    public function getJwksUri(): string
    {
        return $this->jwksUri;
    }

    /**
     * @param string $value
     */
    public function setJwksUri(string $value): self
    {
        $this->jwksUri = $value;
        $this->_setField('jwksUri');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getOpPolicyUri(): ?string
    {
        return $this->opPolicyUri;
    }

    /**
     * @param ?string $value
     */
    public function setOpPolicyUri(?string $value = null): self
    {
        $this->opPolicyUri = $value;
        $this->_setField('opPolicyUri');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getOpTosUri(): ?string
    {
        return $this->opTosUri;
    }

    /**
     * @param ?string $value
     */
    public function setOpTosUri(?string $value = null): self
    {
        $this->opTosUri = $value;
        $this->_setField('opTosUri');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRegistrationEndpoint(): ?string
    {
        return $this->registrationEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setRegistrationEndpoint(?string $value = null): self
    {
        $this->registrationEndpoint = $value;
        $this->_setField('registrationEndpoint');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getRequestObjectEncryptionAlgValuesSupported(): ?array
    {
        return $this->requestObjectEncryptionAlgValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setRequestObjectEncryptionAlgValuesSupported(?array $value = null): self
    {
        $this->requestObjectEncryptionAlgValuesSupported = $value;
        $this->_setField('requestObjectEncryptionAlgValuesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getRequestObjectEncryptionEncValuesSupported(): ?array
    {
        return $this->requestObjectEncryptionEncValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setRequestObjectEncryptionEncValuesSupported(?array $value = null): self
    {
        $this->requestObjectEncryptionEncValuesSupported = $value;
        $this->_setField('requestObjectEncryptionEncValuesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getRequestObjectSigningAlgValuesSupported(): ?array
    {
        return $this->requestObjectSigningAlgValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setRequestObjectSigningAlgValuesSupported(?array $value = null): self
    {
        $this->requestObjectSigningAlgValuesSupported = $value;
        $this->_setField('requestObjectSigningAlgValuesSupported');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRequestParameterSupported(): ?bool
    {
        return $this->requestParameterSupported;
    }

    /**
     * @param ?bool $value
     */
    public function setRequestParameterSupported(?bool $value = null): self
    {
        $this->requestParameterSupported = $value;
        $this->_setField('requestParameterSupported');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRequestUriParameterSupported(): ?bool
    {
        return $this->requestUriParameterSupported;
    }

    /**
     * @param ?bool $value
     */
    public function setRequestUriParameterSupported(?bool $value = null): self
    {
        $this->requestUriParameterSupported = $value;
        $this->_setField('requestUriParameterSupported');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRequireRequestUriRegistration(): ?bool
    {
        return $this->requireRequestUriRegistration;
    }

    /**
     * @param ?bool $value
     */
    public function setRequireRequestUriRegistration(?bool $value = null): self
    {
        $this->requireRequestUriRegistration = $value;
        $this->_setField('requireRequestUriRegistration');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getResponseModesSupported(): ?array
    {
        return $this->responseModesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setResponseModesSupported(?array $value = null): self
    {
        $this->responseModesSupported = $value;
        $this->_setField('responseModesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getResponseTypesSupported(): ?array
    {
        return $this->responseTypesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setResponseTypesSupported(?array $value = null): self
    {
        $this->responseTypesSupported = $value;
        $this->_setField('responseTypesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getScopesSupported(): ?array
    {
        return $this->scopesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setScopesSupported(?array $value = null): self
    {
        $this->scopesSupported = $value;
        $this->_setField('scopesSupported');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getServiceDocumentation(): ?string
    {
        return $this->serviceDocumentation;
    }

    /**
     * @param ?string $value
     */
    public function setServiceDocumentation(?string $value = null): self
    {
        $this->serviceDocumentation = $value;
        $this->_setField('serviceDocumentation');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getSubjectTypesSupported(): ?array
    {
        return $this->subjectTypesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setSubjectTypesSupported(?array $value = null): self
    {
        $this->subjectTypesSupported = $value;
        $this->_setField('subjectTypesSupported');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTokenEndpoint(): ?string
    {
        return $this->tokenEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setTokenEndpoint(?string $value = null): self
    {
        $this->tokenEndpoint = $value;
        $this->_setField('tokenEndpoint');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getTokenEndpointAuthMethodsSupported(): ?array
    {
        return $this->tokenEndpointAuthMethodsSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setTokenEndpointAuthMethodsSupported(?array $value = null): self
    {
        $this->tokenEndpointAuthMethodsSupported = $value;
        $this->_setField('tokenEndpointAuthMethodsSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getTokenEndpointAuthSigningAlgValuesSupported(): ?array
    {
        return $this->tokenEndpointAuthSigningAlgValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setTokenEndpointAuthSigningAlgValuesSupported(?array $value = null): self
    {
        $this->tokenEndpointAuthSigningAlgValuesSupported = $value;
        $this->_setField('tokenEndpointAuthSigningAlgValuesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getUiLocalesSupported(): ?array
    {
        return $this->uiLocalesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setUiLocalesSupported(?array $value = null): self
    {
        $this->uiLocalesSupported = $value;
        $this->_setField('uiLocalesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getUserinfoEncryptionAlgValuesSupported(): ?array
    {
        return $this->userinfoEncryptionAlgValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setUserinfoEncryptionAlgValuesSupported(?array $value = null): self
    {
        $this->userinfoEncryptionAlgValuesSupported = $value;
        $this->_setField('userinfoEncryptionAlgValuesSupported');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getUserinfoEncryptionEncValuesSupported(): ?array
    {
        return $this->userinfoEncryptionEncValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setUserinfoEncryptionEncValuesSupported(?array $value = null): self
    {
        $this->userinfoEncryptionEncValuesSupported = $value;
        $this->_setField('userinfoEncryptionEncValuesSupported');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserinfoEndpoint(): ?string
    {
        return $this->userinfoEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setUserinfoEndpoint(?string $value = null): self
    {
        $this->userinfoEndpoint = $value;
        $this->_setField('userinfoEndpoint');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getUserinfoSigningAlgValuesSupported(): ?array
    {
        return $this->userinfoSigningAlgValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setUserinfoSigningAlgValuesSupported(?array $value = null): self
    {
        $this->userinfoSigningAlgValuesSupported = $value;
        $this->_setField('userinfoSigningAlgValuesSupported');
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
