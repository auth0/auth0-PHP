<?php

namespace Auth0\SDK\API\Management\Emails\Provider\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\EmailProviderNameEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\EmailProviderCredentialsSchemaZero;
use Auth0\SDK\API\Management\Types\EmailProviderCredentialsSchemaAccessKeyId;
use Auth0\SDK\API\Management\Types\EmailProviderCredentialsSchemaSmtpHost;
use Auth0\SDK\API\Management\Types\EmailProviderCredentialsSchemaThree;
use Auth0\SDK\API\Management\Types\EmailProviderCredentialsSchemaApiKey;
use Auth0\SDK\API\Management\Types\EmailProviderCredentialsSchemaConnectionString;
use Auth0\SDK\API\Management\Types\EmailProviderCredentialsSchemaClientId;
use Auth0\SDK\API\Management\Types\ExtensibilityEmailProviderCredentials;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateEmailProviderRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<EmailProviderNameEnum> $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?bool $enabled Whether the provider is enabled (true) or disabled (false).
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @var ?string $defaultFromAddress Email address to use as "from" when no other address specified.
     */
    #[JsonProperty('default_from_address')]
    private ?string $defaultFromAddress;

    /**
     * @var (
     *    EmailProviderCredentialsSchemaZero
     *   |EmailProviderCredentialsSchemaAccessKeyId
     *   |EmailProviderCredentialsSchemaSmtpHost
     *   |EmailProviderCredentialsSchemaThree
     *   |EmailProviderCredentialsSchemaApiKey
     *   |EmailProviderCredentialsSchemaConnectionString
     *   |EmailProviderCredentialsSchemaClientId
     *   |ExtensibilityEmailProviderCredentials
     * ) $credentials
     */
    #[JsonProperty('credentials'), Union(EmailProviderCredentialsSchemaZero::class, EmailProviderCredentialsSchemaAccessKeyId::class, EmailProviderCredentialsSchemaSmtpHost::class, EmailProviderCredentialsSchemaThree::class, EmailProviderCredentialsSchemaApiKey::class, EmailProviderCredentialsSchemaConnectionString::class, EmailProviderCredentialsSchemaClientId::class, ExtensibilityEmailProviderCredentials::class)]
    private EmailProviderCredentialsSchemaZero|EmailProviderCredentialsSchemaAccessKeyId|EmailProviderCredentialsSchemaSmtpHost|EmailProviderCredentialsSchemaThree|EmailProviderCredentialsSchemaApiKey|EmailProviderCredentialsSchemaConnectionString|EmailProviderCredentialsSchemaClientId|ExtensibilityEmailProviderCredentials $credentials;

    /**
     * @var ?array<string, mixed> $settings
     */
    #[JsonProperty('settings'), ArrayType(['string' => 'mixed'])]
    private ?array $settings;

    /**
     * @param array{
     *   name: value-of<EmailProviderNameEnum>,
     *   credentials: (
     *    EmailProviderCredentialsSchemaZero
     *   |EmailProviderCredentialsSchemaAccessKeyId
     *   |EmailProviderCredentialsSchemaSmtpHost
     *   |EmailProviderCredentialsSchemaThree
     *   |EmailProviderCredentialsSchemaApiKey
     *   |EmailProviderCredentialsSchemaConnectionString
     *   |EmailProviderCredentialsSchemaClientId
     *   |ExtensibilityEmailProviderCredentials
     * ),
     *   enabled?: ?bool,
     *   defaultFromAddress?: ?string,
     *   settings?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->enabled = $values['enabled'] ?? null;
        $this->defaultFromAddress = $values['defaultFromAddress'] ?? null;
        $this->credentials = $values['credentials'];
        $this->settings = $values['settings'] ?? null;
    }

    /**
     * @return value-of<EmailProviderNameEnum>
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param value-of<EmailProviderNameEnum> $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
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
     * @return ?string
     */
    public function getDefaultFromAddress(): ?string
    {
        return $this->defaultFromAddress;
    }

    /**
     * @param ?string $value
     */
    public function setDefaultFromAddress(?string $value = null): self
    {
        $this->defaultFromAddress = $value;
        $this->_setField('defaultFromAddress');
        return $this;
    }

    /**
     * @return (
     *    EmailProviderCredentialsSchemaZero
     *   |EmailProviderCredentialsSchemaAccessKeyId
     *   |EmailProviderCredentialsSchemaSmtpHost
     *   |EmailProviderCredentialsSchemaThree
     *   |EmailProviderCredentialsSchemaApiKey
     *   |EmailProviderCredentialsSchemaConnectionString
     *   |EmailProviderCredentialsSchemaClientId
     *   |ExtensibilityEmailProviderCredentials
     * )
     */
    public function getCredentials(): EmailProviderCredentialsSchemaZero|EmailProviderCredentialsSchemaAccessKeyId|EmailProviderCredentialsSchemaSmtpHost|EmailProviderCredentialsSchemaThree|EmailProviderCredentialsSchemaApiKey|EmailProviderCredentialsSchemaConnectionString|EmailProviderCredentialsSchemaClientId|ExtensibilityEmailProviderCredentials
    {
        return $this->credentials;
    }

    /**
     * @param (
     *    EmailProviderCredentialsSchemaZero
     *   |EmailProviderCredentialsSchemaAccessKeyId
     *   |EmailProviderCredentialsSchemaSmtpHost
     *   |EmailProviderCredentialsSchemaThree
     *   |EmailProviderCredentialsSchemaApiKey
     *   |EmailProviderCredentialsSchemaConnectionString
     *   |EmailProviderCredentialsSchemaClientId
     *   |ExtensibilityEmailProviderCredentials
     * ) $value
     */
    public function setCredentials(EmailProviderCredentialsSchemaZero|EmailProviderCredentialsSchemaAccessKeyId|EmailProviderCredentialsSchemaSmtpHost|EmailProviderCredentialsSchemaThree|EmailProviderCredentialsSchemaApiKey|EmailProviderCredentialsSchemaConnectionString|EmailProviderCredentialsSchemaClientId|ExtensibilityEmailProviderCredentials $value): self
    {
        $this->credentials = $value;
        $this->_setField('credentials');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getSettings(): ?array
    {
        return $this->settings;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setSettings(?array $value = null): self
    {
        $this->settings = $value;
        $this->_setField('settings');
        return $this;
    }
}
