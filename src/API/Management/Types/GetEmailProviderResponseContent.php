<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetEmailProviderResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $name Name of the email provider. Can be `mailgun`, `mandrill`, `sendgrid`, `ses`, `sparkpost`, `smtp`, `azure_cs`, `ms365`, or `custom`.
     */
    #[JsonProperty('name')]
    private ?string $name;

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
     * @var ?EmailProviderCredentials $credentials
     */
    #[JsonProperty('credentials')]
    private ?EmailProviderCredentials $credentials;

    /**
     * @var ?array<string, mixed> $settings
     */
    #[JsonProperty('settings'), ArrayType(['string' => 'mixed'])]
    private ?array $settings;

    /**
     * @param array{
     *   name?: ?string,
     *   enabled?: ?bool,
     *   defaultFromAddress?: ?string,
     *   credentials?: ?EmailProviderCredentials,
     *   settings?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
        $this->defaultFromAddress = $values['defaultFromAddress'] ?? null;
        $this->credentials = $values['credentials'] ?? null;
        $this->settings = $values['settings'] ?? null;
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
     * @return ?EmailProviderCredentials
     */
    public function getCredentials(): ?EmailProviderCredentials
    {
        return $this->credentials;
    }

    /**
     * @param ?EmailProviderCredentials $value
     */
    public function setCredentials(?EmailProviderCredentials $value = null): self
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
