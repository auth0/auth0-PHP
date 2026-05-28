<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The connection's options (depend on the connection strategy)
 */
class ConnectionPropertiesOptions extends JsonSerializableType
{
    /**
     * @var ?ConnectionValidationOptions $validation
     */
    #[JsonProperty('validation')]
    private ?ConnectionValidationOptions $validation;

    /**
     * @var ?array<string> $nonPersistentAttrs An array of user fields that should not be stored in the Auth0 database (https://auth0.com/docs/security/data-security/denylist)
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @var ?array<value-of<ConnectionIdentifierPrecedenceEnum>> $precedence Order of precedence for attribute types. If the property is not specified, the default precedence of attributes will be used.
     */
    #[JsonProperty('precedence'), ArrayType(['string'])]
    private ?array $precedence;

    /**
     * @var ?ConnectionAttributes $attributes
     */
    #[JsonProperty('attributes')]
    private ?ConnectionAttributes $attributes;

    /**
     * @var ?bool $enableScriptContext Set to true to inject context into custom DB scripts (warning: cannot be disabled once enabled)
     */
    #[JsonProperty('enable_script_context')]
    private ?bool $enableScriptContext;

    /**
     * @var ?bool $enabledDatabaseCustomization Set to true to use a legacy user store
     */
    #[JsonProperty('enabledDatabaseCustomization')]
    private ?bool $enabledDatabaseCustomization;

    /**
     * @var ?bool $importMode Enable this if you have a legacy user store and you want to gradually migrate those users to the Auth0 user store
     */
    #[JsonProperty('import_mode')]
    private ?bool $importMode;

    /**
     * @var ?array<string, ?string> $configuration Stores encrypted string only configurations for connections
     */
    #[JsonProperty('configuration'), ArrayType(['string' => new Union('string', 'null')])]
    private ?array $configuration;

    /**
     * @var ?ConnectionCustomScripts $customScripts
     */
    #[JsonProperty('customScripts')]
    private ?ConnectionCustomScripts $customScripts;

    /**
     * @var ?ConnectionAuthenticationMethods $authenticationMethods
     */
    #[JsonProperty('authentication_methods')]
    private ?ConnectionAuthenticationMethods $authenticationMethods;

    /**
     * @var ?ConnectionPasskeyOptions $passkeyOptions
     */
    #[JsonProperty('passkey_options')]
    private ?ConnectionPasskeyOptions $passkeyOptions;

    /**
     * @var ?value-of<ConnectionPasswordPolicyEnum> $passwordPolicy
     */
    #[JsonProperty('passwordPolicy')]
    private ?string $passwordPolicy;

    /**
     * @var ?ConnectionPasswordComplexityOptions $passwordComplexityOptions
     */
    #[JsonProperty('password_complexity_options')]
    private ?ConnectionPasswordComplexityOptions $passwordComplexityOptions;

    /**
     * @var ?ConnectionPasswordHistoryOptions $passwordHistory
     */
    #[JsonProperty('password_history')]
    private ?ConnectionPasswordHistoryOptions $passwordHistory;

    /**
     * @var ?ConnectionPasswordNoPersonalInfoOptions $passwordNoPersonalInfo
     */
    #[JsonProperty('password_no_personal_info')]
    private ?ConnectionPasswordNoPersonalInfoOptions $passwordNoPersonalInfo;

    /**
     * @var ?ConnectionPasswordDictionaryOptions $passwordDictionary
     */
    #[JsonProperty('password_dictionary')]
    private ?ConnectionPasswordDictionaryOptions $passwordDictionary;

    /**
     * @var ?bool $apiEnableUsers
     */
    #[JsonProperty('api_enable_users')]
    private ?bool $apiEnableUsers;

    /**
     * @var ?bool $apiEnableGroups
     */
    #[JsonProperty('api_enable_groups')]
    private ?bool $apiEnableGroups;

    /**
     * @var ?bool $basicProfile
     */
    #[JsonProperty('basic_profile')]
    private ?bool $basicProfile;

    /**
     * @var ?bool $extAdmin
     */
    #[JsonProperty('ext_admin')]
    private ?bool $extAdmin;

    /**
     * @var ?bool $extIsSuspended
     */
    #[JsonProperty('ext_is_suspended')]
    private ?bool $extIsSuspended;

    /**
     * @var ?bool $extAgreedTerms
     */
    #[JsonProperty('ext_agreed_terms')]
    private ?bool $extAgreedTerms;

    /**
     * @var ?bool $extGroups
     */
    #[JsonProperty('ext_groups')]
    private ?bool $extGroups;

    /**
     * @var ?bool $extAssignedPlans
     */
    #[JsonProperty('ext_assigned_plans')]
    private ?bool $extAssignedPlans;

    /**
     * @var ?bool $extProfile
     */
    #[JsonProperty('ext_profile')]
    private ?bool $extProfile;

    /**
     * @var ?bool $disableSelfServiceChangePassword
     */
    #[JsonProperty('disable_self_service_change_password')]
    private ?bool $disableSelfServiceChangePassword;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?ConnectionGatewayAuthentication $gatewayAuthentication
     */
    #[JsonProperty('gateway_authentication')]
    private ?ConnectionGatewayAuthentication $gatewayAuthentication;

    /**
     * @var ?ConnectionFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens
     */
    #[JsonProperty('federated_connections_access_tokens')]
    private ?ConnectionFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens;

    /**
     * @var ?ConnectionPasswordOptions $passwordOptions
     */
    #[JsonProperty('password_options')]
    private ?ConnectionPasswordOptions $passwordOptions;

    /**
     * @var ?ConnectionAssertionDecryptionSettings $assertionDecryptionSettings
     */
    #[JsonProperty('assertion_decryption_settings')]
    private ?ConnectionAssertionDecryptionSettings $assertionDecryptionSettings;

    /**
     * @var ?array<value-of<ConnectionIdTokenSignedResponseAlgEnum>> $idTokenSignedResponseAlgs
     */
    #[JsonProperty('id_token_signed_response_algs'), ArrayType(['string'])]
    private ?array $idTokenSignedResponseAlgs;

    /**
     * @var ?value-of<ConnectionDpopSigningAlgEnum> $dpopSigningAlg
     */
    #[JsonProperty('dpop_signing_alg')]
    private ?string $dpopSigningAlg;

    /**
     * @var ?value-of<ConnectionTokenEndpointAuthMethodEnum> $tokenEndpointAuthMethod
     */
    #[JsonProperty('token_endpoint_auth_method')]
    private ?string $tokenEndpointAuthMethod;

    /**
     * @var ?value-of<ConnectionTokenEndpointAuthSigningAlgEnum> $tokenEndpointAuthSigningAlg
     */
    #[JsonProperty('token_endpoint_auth_signing_alg')]
    private ?string $tokenEndpointAuthSigningAlg;

    /**
     * @var ?value-of<ConnectionTokenEndpointJwtcaAudFormatEnumOidc> $tokenEndpointJwtcaAudFormat
     */
    #[JsonProperty('token_endpoint_jwtca_aud_format')]
    private ?string $tokenEndpointJwtcaAudFormat;

    /**
     * @param array{
     *   validation?: ?ConnectionValidationOptions,
     *   nonPersistentAttrs?: ?array<string>,
     *   precedence?: ?array<value-of<ConnectionIdentifierPrecedenceEnum>>,
     *   attributes?: ?ConnectionAttributes,
     *   enableScriptContext?: ?bool,
     *   enabledDatabaseCustomization?: ?bool,
     *   importMode?: ?bool,
     *   configuration?: ?array<string, ?string>,
     *   customScripts?: ?ConnectionCustomScripts,
     *   authenticationMethods?: ?ConnectionAuthenticationMethods,
     *   passkeyOptions?: ?ConnectionPasskeyOptions,
     *   passwordPolicy?: ?value-of<ConnectionPasswordPolicyEnum>,
     *   passwordComplexityOptions?: ?ConnectionPasswordComplexityOptions,
     *   passwordHistory?: ?ConnectionPasswordHistoryOptions,
     *   passwordNoPersonalInfo?: ?ConnectionPasswordNoPersonalInfoOptions,
     *   passwordDictionary?: ?ConnectionPasswordDictionaryOptions,
     *   apiEnableUsers?: ?bool,
     *   apiEnableGroups?: ?bool,
     *   basicProfile?: ?bool,
     *   extAdmin?: ?bool,
     *   extIsSuspended?: ?bool,
     *   extAgreedTerms?: ?bool,
     *   extGroups?: ?bool,
     *   extAssignedPlans?: ?bool,
     *   extProfile?: ?bool,
     *   disableSelfServiceChangePassword?: ?bool,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   gatewayAuthentication?: ?ConnectionGatewayAuthentication,
     *   federatedConnectionsAccessTokens?: ?ConnectionFederatedConnectionsAccessTokens,
     *   passwordOptions?: ?ConnectionPasswordOptions,
     *   assertionDecryptionSettings?: ?ConnectionAssertionDecryptionSettings,
     *   idTokenSignedResponseAlgs?: ?array<value-of<ConnectionIdTokenSignedResponseAlgEnum>>,
     *   dpopSigningAlg?: ?value-of<ConnectionDpopSigningAlgEnum>,
     *   tokenEndpointAuthMethod?: ?value-of<ConnectionTokenEndpointAuthMethodEnum>,
     *   tokenEndpointAuthSigningAlg?: ?value-of<ConnectionTokenEndpointAuthSigningAlgEnum>,
     *   tokenEndpointJwtcaAudFormat?: ?value-of<ConnectionTokenEndpointJwtcaAudFormatEnumOidc>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->validation = $values['validation'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->precedence = $values['precedence'] ?? null;
        $this->attributes = $values['attributes'] ?? null;
        $this->enableScriptContext = $values['enableScriptContext'] ?? null;
        $this->enabledDatabaseCustomization = $values['enabledDatabaseCustomization'] ?? null;
        $this->importMode = $values['importMode'] ?? null;
        $this->configuration = $values['configuration'] ?? null;
        $this->customScripts = $values['customScripts'] ?? null;
        $this->authenticationMethods = $values['authenticationMethods'] ?? null;
        $this->passkeyOptions = $values['passkeyOptions'] ?? null;
        $this->passwordPolicy = $values['passwordPolicy'] ?? null;
        $this->passwordComplexityOptions = $values['passwordComplexityOptions'] ?? null;
        $this->passwordHistory = $values['passwordHistory'] ?? null;
        $this->passwordNoPersonalInfo = $values['passwordNoPersonalInfo'] ?? null;
        $this->passwordDictionary = $values['passwordDictionary'] ?? null;
        $this->apiEnableUsers = $values['apiEnableUsers'] ?? null;
        $this->apiEnableGroups = $values['apiEnableGroups'] ?? null;
        $this->basicProfile = $values['basicProfile'] ?? null;
        $this->extAdmin = $values['extAdmin'] ?? null;
        $this->extIsSuspended = $values['extIsSuspended'] ?? null;
        $this->extAgreedTerms = $values['extAgreedTerms'] ?? null;
        $this->extGroups = $values['extGroups'] ?? null;
        $this->extAssignedPlans = $values['extAssignedPlans'] ?? null;
        $this->extProfile = $values['extProfile'] ?? null;
        $this->disableSelfServiceChangePassword = $values['disableSelfServiceChangePassword'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->gatewayAuthentication = $values['gatewayAuthentication'] ?? null;
        $this->federatedConnectionsAccessTokens = $values['federatedConnectionsAccessTokens'] ?? null;
        $this->passwordOptions = $values['passwordOptions'] ?? null;
        $this->assertionDecryptionSettings = $values['assertionDecryptionSettings'] ?? null;
        $this->idTokenSignedResponseAlgs = $values['idTokenSignedResponseAlgs'] ?? null;
        $this->dpopSigningAlg = $values['dpopSigningAlg'] ?? null;
        $this->tokenEndpointAuthMethod = $values['tokenEndpointAuthMethod'] ?? null;
        $this->tokenEndpointAuthSigningAlg = $values['tokenEndpointAuthSigningAlg'] ?? null;
        $this->tokenEndpointJwtcaAudFormat = $values['tokenEndpointJwtcaAudFormat'] ?? null;
    }

    /**
     * @return ?ConnectionValidationOptions
     */
    public function getValidation(): ?ConnectionValidationOptions
    {
        return $this->validation;
    }

    /**
     * @param ?ConnectionValidationOptions $value
     */
    public function setValidation(?ConnectionValidationOptions $value = null): self
    {
        $this->validation = $value;
        $this->_setField('validation');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getNonPersistentAttrs(): ?array
    {
        return $this->nonPersistentAttrs;
    }

    /**
     * @param ?array<string> $value
     */
    public function setNonPersistentAttrs(?array $value = null): self
    {
        $this->nonPersistentAttrs = $value;
        $this->_setField('nonPersistentAttrs');
        return $this;
    }

    /**
     * @return ?array<value-of<ConnectionIdentifierPrecedenceEnum>>
     */
    public function getPrecedence(): ?array
    {
        return $this->precedence;
    }

    /**
     * @param ?array<value-of<ConnectionIdentifierPrecedenceEnum>> $value
     */
    public function setPrecedence(?array $value = null): self
    {
        $this->precedence = $value;
        $this->_setField('precedence');
        return $this;
    }

    /**
     * @return ?ConnectionAttributes
     */
    public function getAttributes(): ?ConnectionAttributes
    {
        return $this->attributes;
    }

    /**
     * @param ?ConnectionAttributes $value
     */
    public function setAttributes(?ConnectionAttributes $value = null): self
    {
        $this->attributes = $value;
        $this->_setField('attributes');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnableScriptContext(): ?bool
    {
        return $this->enableScriptContext;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableScriptContext(?bool $value = null): self
    {
        $this->enableScriptContext = $value;
        $this->_setField('enableScriptContext');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnabledDatabaseCustomization(): ?bool
    {
        return $this->enabledDatabaseCustomization;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabledDatabaseCustomization(?bool $value = null): self
    {
        $this->enabledDatabaseCustomization = $value;
        $this->_setField('enabledDatabaseCustomization');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getImportMode(): ?bool
    {
        return $this->importMode;
    }

    /**
     * @param ?bool $value
     */
    public function setImportMode(?bool $value = null): self
    {
        $this->importMode = $value;
        $this->_setField('importMode');
        return $this;
    }

    /**
     * @return ?array<string, ?string>
     */
    public function getConfiguration(): ?array
    {
        return $this->configuration;
    }

    /**
     * @param ?array<string, ?string> $value
     */
    public function setConfiguration(?array $value = null): self
    {
        $this->configuration = $value;
        $this->_setField('configuration');
        return $this;
    }

    /**
     * @return ?ConnectionCustomScripts
     */
    public function getCustomScripts(): ?ConnectionCustomScripts
    {
        return $this->customScripts;
    }

    /**
     * @param ?ConnectionCustomScripts $value
     */
    public function setCustomScripts(?ConnectionCustomScripts $value = null): self
    {
        $this->customScripts = $value;
        $this->_setField('customScripts');
        return $this;
    }

    /**
     * @return ?ConnectionAuthenticationMethods
     */
    public function getAuthenticationMethods(): ?ConnectionAuthenticationMethods
    {
        return $this->authenticationMethods;
    }

    /**
     * @param ?ConnectionAuthenticationMethods $value
     */
    public function setAuthenticationMethods(?ConnectionAuthenticationMethods $value = null): self
    {
        $this->authenticationMethods = $value;
        $this->_setField('authenticationMethods');
        return $this;
    }

    /**
     * @return ?ConnectionPasskeyOptions
     */
    public function getPasskeyOptions(): ?ConnectionPasskeyOptions
    {
        return $this->passkeyOptions;
    }

    /**
     * @param ?ConnectionPasskeyOptions $value
     */
    public function setPasskeyOptions(?ConnectionPasskeyOptions $value = null): self
    {
        $this->passkeyOptions = $value;
        $this->_setField('passkeyOptions');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionPasswordPolicyEnum>
     */
    public function getPasswordPolicy(): ?string
    {
        return $this->passwordPolicy;
    }

    /**
     * @param ?value-of<ConnectionPasswordPolicyEnum> $value
     */
    public function setPasswordPolicy(?string $value = null): self
    {
        $this->passwordPolicy = $value;
        $this->_setField('passwordPolicy');
        return $this;
    }

    /**
     * @return ?ConnectionPasswordComplexityOptions
     */
    public function getPasswordComplexityOptions(): ?ConnectionPasswordComplexityOptions
    {
        return $this->passwordComplexityOptions;
    }

    /**
     * @param ?ConnectionPasswordComplexityOptions $value
     */
    public function setPasswordComplexityOptions(?ConnectionPasswordComplexityOptions $value = null): self
    {
        $this->passwordComplexityOptions = $value;
        $this->_setField('passwordComplexityOptions');
        return $this;
    }

    /**
     * @return ?ConnectionPasswordHistoryOptions
     */
    public function getPasswordHistory(): ?ConnectionPasswordHistoryOptions
    {
        return $this->passwordHistory;
    }

    /**
     * @param ?ConnectionPasswordHistoryOptions $value
     */
    public function setPasswordHistory(?ConnectionPasswordHistoryOptions $value = null): self
    {
        $this->passwordHistory = $value;
        $this->_setField('passwordHistory');
        return $this;
    }

    /**
     * @return ?ConnectionPasswordNoPersonalInfoOptions
     */
    public function getPasswordNoPersonalInfo(): ?ConnectionPasswordNoPersonalInfoOptions
    {
        return $this->passwordNoPersonalInfo;
    }

    /**
     * @param ?ConnectionPasswordNoPersonalInfoOptions $value
     */
    public function setPasswordNoPersonalInfo(?ConnectionPasswordNoPersonalInfoOptions $value = null): self
    {
        $this->passwordNoPersonalInfo = $value;
        $this->_setField('passwordNoPersonalInfo');
        return $this;
    }

    /**
     * @return ?ConnectionPasswordDictionaryOptions
     */
    public function getPasswordDictionary(): ?ConnectionPasswordDictionaryOptions
    {
        return $this->passwordDictionary;
    }

    /**
     * @param ?ConnectionPasswordDictionaryOptions $value
     */
    public function setPasswordDictionary(?ConnectionPasswordDictionaryOptions $value = null): self
    {
        $this->passwordDictionary = $value;
        $this->_setField('passwordDictionary');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getApiEnableUsers(): ?bool
    {
        return $this->apiEnableUsers;
    }

    /**
     * @param ?bool $value
     */
    public function setApiEnableUsers(?bool $value = null): self
    {
        $this->apiEnableUsers = $value;
        $this->_setField('apiEnableUsers');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getApiEnableGroups(): ?bool
    {
        return $this->apiEnableGroups;
    }

    /**
     * @param ?bool $value
     */
    public function setApiEnableGroups(?bool $value = null): self
    {
        $this->apiEnableGroups = $value;
        $this->_setField('apiEnableGroups');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBasicProfile(): ?bool
    {
        return $this->basicProfile;
    }

    /**
     * @param ?bool $value
     */
    public function setBasicProfile(?bool $value = null): self
    {
        $this->basicProfile = $value;
        $this->_setField('basicProfile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtAdmin(): ?bool
    {
        return $this->extAdmin;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAdmin(?bool $value = null): self
    {
        $this->extAdmin = $value;
        $this->_setField('extAdmin');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtIsSuspended(): ?bool
    {
        return $this->extIsSuspended;
    }

    /**
     * @param ?bool $value
     */
    public function setExtIsSuspended(?bool $value = null): self
    {
        $this->extIsSuspended = $value;
        $this->_setField('extIsSuspended');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtAgreedTerms(): ?bool
    {
        return $this->extAgreedTerms;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAgreedTerms(?bool $value = null): self
    {
        $this->extAgreedTerms = $value;
        $this->_setField('extAgreedTerms');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtGroups(): ?bool
    {
        return $this->extGroups;
    }

    /**
     * @param ?bool $value
     */
    public function setExtGroups(?bool $value = null): self
    {
        $this->extGroups = $value;
        $this->_setField('extGroups');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtAssignedPlans(): ?bool
    {
        return $this->extAssignedPlans;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAssignedPlans(?bool $value = null): self
    {
        $this->extAssignedPlans = $value;
        $this->_setField('extAssignedPlans');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtProfile(): ?bool
    {
        return $this->extProfile;
    }

    /**
     * @param ?bool $value
     */
    public function setExtProfile(?bool $value = null): self
    {
        $this->extProfile = $value;
        $this->_setField('extProfile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableSelfServiceChangePassword(): ?bool
    {
        return $this->disableSelfServiceChangePassword;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableSelfServiceChangePassword(?bool $value = null): self
    {
        $this->disableSelfServiceChangePassword = $value;
        $this->_setField('disableSelfServiceChangePassword');
        return $this;
    }

    /**
     * @return ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>
     */
    public function getUpstreamParams(): ?array
    {
        return $this->upstreamParams;
    }

    /**
     * @param ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $value
     */
    public function setUpstreamParams(?array $value = null): self
    {
        $this->upstreamParams = $value;
        $this->_setField('upstreamParams');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<ConnectionSetUserRootAttributesEnum> $value
     */
    public function setSetUserRootAttributes(?string $value = null): self
    {
        $this->setUserRootAttributes = $value;
        $this->_setField('setUserRootAttributes');
        return $this;
    }

    /**
     * @return ?ConnectionGatewayAuthentication
     */
    public function getGatewayAuthentication(): ?ConnectionGatewayAuthentication
    {
        return $this->gatewayAuthentication;
    }

    /**
     * @param ?ConnectionGatewayAuthentication $value
     */
    public function setGatewayAuthentication(?ConnectionGatewayAuthentication $value = null): self
    {
        $this->gatewayAuthentication = $value;
        $this->_setField('gatewayAuthentication');
        return $this;
    }

    /**
     * @return ?ConnectionFederatedConnectionsAccessTokens
     */
    public function getFederatedConnectionsAccessTokens(): ?ConnectionFederatedConnectionsAccessTokens
    {
        return $this->federatedConnectionsAccessTokens;
    }

    /**
     * @param ?ConnectionFederatedConnectionsAccessTokens $value
     */
    public function setFederatedConnectionsAccessTokens(?ConnectionFederatedConnectionsAccessTokens $value = null): self
    {
        $this->federatedConnectionsAccessTokens = $value;
        $this->_setField('federatedConnectionsAccessTokens');
        return $this;
    }

    /**
     * @return ?ConnectionPasswordOptions
     */
    public function getPasswordOptions(): ?ConnectionPasswordOptions
    {
        return $this->passwordOptions;
    }

    /**
     * @param ?ConnectionPasswordOptions $value
     */
    public function setPasswordOptions(?ConnectionPasswordOptions $value = null): self
    {
        $this->passwordOptions = $value;
        $this->_setField('passwordOptions');
        return $this;
    }

    /**
     * @return ?ConnectionAssertionDecryptionSettings
     */
    public function getAssertionDecryptionSettings(): ?ConnectionAssertionDecryptionSettings
    {
        return $this->assertionDecryptionSettings;
    }

    /**
     * @param ?ConnectionAssertionDecryptionSettings $value
     */
    public function setAssertionDecryptionSettings(?ConnectionAssertionDecryptionSettings $value = null): self
    {
        $this->assertionDecryptionSettings = $value;
        $this->_setField('assertionDecryptionSettings');
        return $this;
    }

    /**
     * @return ?array<value-of<ConnectionIdTokenSignedResponseAlgEnum>>
     */
    public function getIdTokenSignedResponseAlgs(): ?array
    {
        return $this->idTokenSignedResponseAlgs;
    }

    /**
     * @param ?array<value-of<ConnectionIdTokenSignedResponseAlgEnum>> $value
     */
    public function setIdTokenSignedResponseAlgs(?array $value = null): self
    {
        $this->idTokenSignedResponseAlgs = $value;
        $this->_setField('idTokenSignedResponseAlgs');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionDpopSigningAlgEnum>
     */
    public function getDpopSigningAlg(): ?string
    {
        return $this->dpopSigningAlg;
    }

    /**
     * @param ?value-of<ConnectionDpopSigningAlgEnum> $value
     */
    public function setDpopSigningAlg(?string $value = null): self
    {
        $this->dpopSigningAlg = $value;
        $this->_setField('dpopSigningAlg');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionTokenEndpointAuthMethodEnum>
     */
    public function getTokenEndpointAuthMethod(): ?string
    {
        return $this->tokenEndpointAuthMethod;
    }

    /**
     * @param ?value-of<ConnectionTokenEndpointAuthMethodEnum> $value
     */
    public function setTokenEndpointAuthMethod(?string $value = null): self
    {
        $this->tokenEndpointAuthMethod = $value;
        $this->_setField('tokenEndpointAuthMethod');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionTokenEndpointAuthSigningAlgEnum>
     */
    public function getTokenEndpointAuthSigningAlg(): ?string
    {
        return $this->tokenEndpointAuthSigningAlg;
    }

    /**
     * @param ?value-of<ConnectionTokenEndpointAuthSigningAlgEnum> $value
     */
    public function setTokenEndpointAuthSigningAlg(?string $value = null): self
    {
        $this->tokenEndpointAuthSigningAlg = $value;
        $this->_setField('tokenEndpointAuthSigningAlg');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionTokenEndpointJwtcaAudFormatEnumOidc>
     */
    public function getTokenEndpointJwtcaAudFormat(): ?string
    {
        return $this->tokenEndpointJwtcaAudFormat;
    }

    /**
     * @param ?value-of<ConnectionTokenEndpointJwtcaAudFormatEnumOidc> $value
     */
    public function setTokenEndpointJwtcaAudFormat(?string $value = null): self
    {
        $this->tokenEndpointJwtcaAudFormat = $value;
        $this->_setField('tokenEndpointJwtcaAudFormat');
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
