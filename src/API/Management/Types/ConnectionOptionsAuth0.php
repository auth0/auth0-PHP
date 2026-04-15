<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Options for the 'auth0' connection
 */
class ConnectionOptionsAuth0 extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?ConnectionAttributes $attributes
     */
    #[JsonProperty('attributes')]
    private ?ConnectionAttributes $attributes;

    /**
     * @var ?ConnectionAuthenticationMethods $authenticationMethods
     */
    #[JsonProperty('authentication_methods')]
    private ?ConnectionAuthenticationMethods $authenticationMethods;

    /**
     * @var ?bool $bruteForceProtection
     */
    #[JsonProperty('brute_force_protection')]
    private ?bool $bruteForceProtection;

    /**
     * @var ?array<string, string> $configuration
     */
    #[JsonProperty('configuration'), ArrayType(['string' => 'string'])]
    private ?array $configuration;

    /**
     * @var ?ConnectionCustomScripts $customScripts
     */
    #[JsonProperty('customScripts')]
    private ?ConnectionCustomScripts $customScripts;

    /**
     * @var ?bool $disableSelfServiceChangePassword
     */
    #[JsonProperty('disable_self_service_change_password')]
    private ?bool $disableSelfServiceChangePassword;

    /**
     * @var ?bool $disableSignup
     */
    #[JsonProperty('disable_signup')]
    private ?bool $disableSignup;

    /**
     * @var ?bool $enableScriptContext
     */
    #[JsonProperty('enable_script_context')]
    private ?bool $enableScriptContext;

    /**
     * @var ?bool $enabledDatabaseCustomization
     */
    #[JsonProperty('enabledDatabaseCustomization')]
    private ?bool $enabledDatabaseCustomization;

    /**
     * @var ?bool $importMode
     */
    #[JsonProperty('import_mode')]
    private ?bool $importMode;

    /**
     * @var ?ConnectionMfa $mfa
     */
    #[JsonProperty('mfa')]
    private ?ConnectionMfa $mfa;

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
     * @var ?ConnectionPasswordDictionaryOptions $passwordDictionary
     */
    #[JsonProperty('password_dictionary')]
    private ?ConnectionPasswordDictionaryOptions $passwordDictionary;

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
     * @var ?ConnectionPasswordOptions $passwordOptions
     */
    #[JsonProperty('password_options')]
    private ?ConnectionPasswordOptions $passwordOptions;

    /**
     * @var ?array<value-of<ConnectionIdentifierPrecedenceEnum>> $precedence
     */
    #[JsonProperty('precedence'), ArrayType(['string'])]
    private ?array $precedence;

    /**
     * @var ?bool $realmFallback
     */
    #[JsonProperty('realm_fallback')]
    private ?bool $realmFallback;

    /**
     * @var ?bool $requiresUsername
     */
    #[JsonProperty('requires_username')]
    private ?bool $requiresUsername;

    /**
     * @var ?ConnectionValidationOptions $validation
     */
    #[JsonProperty('validation')]
    private ?ConnectionValidationOptions $validation;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   attributes?: ?ConnectionAttributes,
     *   authenticationMethods?: ?ConnectionAuthenticationMethods,
     *   bruteForceProtection?: ?bool,
     *   configuration?: ?array<string, string>,
     *   customScripts?: ?ConnectionCustomScripts,
     *   disableSelfServiceChangePassword?: ?bool,
     *   disableSignup?: ?bool,
     *   enableScriptContext?: ?bool,
     *   enabledDatabaseCustomization?: ?bool,
     *   importMode?: ?bool,
     *   mfa?: ?ConnectionMfa,
     *   passkeyOptions?: ?ConnectionPasskeyOptions,
     *   passwordPolicy?: ?value-of<ConnectionPasswordPolicyEnum>,
     *   passwordComplexityOptions?: ?ConnectionPasswordComplexityOptions,
     *   passwordDictionary?: ?ConnectionPasswordDictionaryOptions,
     *   passwordHistory?: ?ConnectionPasswordHistoryOptions,
     *   passwordNoPersonalInfo?: ?ConnectionPasswordNoPersonalInfoOptions,
     *   passwordOptions?: ?ConnectionPasswordOptions,
     *   precedence?: ?array<value-of<ConnectionIdentifierPrecedenceEnum>>,
     *   realmFallback?: ?bool,
     *   requiresUsername?: ?bool,
     *   validation?: ?ConnectionValidationOptions,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->attributes = $values['attributes'] ?? null;
        $this->authenticationMethods = $values['authenticationMethods'] ?? null;
        $this->bruteForceProtection = $values['bruteForceProtection'] ?? null;
        $this->configuration = $values['configuration'] ?? null;
        $this->customScripts = $values['customScripts'] ?? null;
        $this->disableSelfServiceChangePassword = $values['disableSelfServiceChangePassword'] ?? null;
        $this->disableSignup = $values['disableSignup'] ?? null;
        $this->enableScriptContext = $values['enableScriptContext'] ?? null;
        $this->enabledDatabaseCustomization = $values['enabledDatabaseCustomization'] ?? null;
        $this->importMode = $values['importMode'] ?? null;
        $this->mfa = $values['mfa'] ?? null;
        $this->passkeyOptions = $values['passkeyOptions'] ?? null;
        $this->passwordPolicy = $values['passwordPolicy'] ?? null;
        $this->passwordComplexityOptions = $values['passwordComplexityOptions'] ?? null;
        $this->passwordDictionary = $values['passwordDictionary'] ?? null;
        $this->passwordHistory = $values['passwordHistory'] ?? null;
        $this->passwordNoPersonalInfo = $values['passwordNoPersonalInfo'] ?? null;
        $this->passwordOptions = $values['passwordOptions'] ?? null;
        $this->precedence = $values['precedence'] ?? null;
        $this->realmFallback = $values['realmFallback'] ?? null;
        $this->requiresUsername = $values['requiresUsername'] ?? null;
        $this->validation = $values['validation'] ?? null;
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
     * @return ?bool
     */
    public function getBruteForceProtection(): ?bool
    {
        return $this->bruteForceProtection;
    }

    /**
     * @param ?bool $value
     */
    public function setBruteForceProtection(?bool $value = null): self
    {
        $this->bruteForceProtection = $value;
        $this->_setField('bruteForceProtection');
        return $this;
    }

    /**
     * @return ?array<string, string>
     */
    public function getConfiguration(): ?array
    {
        return $this->configuration;
    }

    /**
     * @param ?array<string, string> $value
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
     * @return ?bool
     */
    public function getDisableSignup(): ?bool
    {
        return $this->disableSignup;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableSignup(?bool $value = null): self
    {
        $this->disableSignup = $value;
        $this->_setField('disableSignup');
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
     * @return ?ConnectionMfa
     */
    public function getMfa(): ?ConnectionMfa
    {
        return $this->mfa;
    }

    /**
     * @param ?ConnectionMfa $value
     */
    public function setMfa(?ConnectionMfa $value = null): self
    {
        $this->mfa = $value;
        $this->_setField('mfa');
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
     * @return ?bool
     */
    public function getRealmFallback(): ?bool
    {
        return $this->realmFallback;
    }

    /**
     * @param ?bool $value
     */
    public function setRealmFallback(?bool $value = null): self
    {
        $this->realmFallback = $value;
        $this->_setField('realmFallback');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRequiresUsername(): ?bool
    {
        return $this->requiresUsername;
    }

    /**
     * @param ?bool $value
     */
    public function setRequiresUsername(?bool $value = null): self
    {
        $this->requiresUsername = $value;
        $this->_setField('requiresUsername');
        return $this;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
