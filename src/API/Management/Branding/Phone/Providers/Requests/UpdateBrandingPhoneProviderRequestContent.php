<?php

namespace Auth0\SDK\API\Management\Branding\Phone\Providers\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\PhoneProviderNameEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\TwilioProviderCredentials;
use Auth0\SDK\API\Management\Types\CustomProviderCredentials;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Types\TwilioProviderConfiguration;
use Auth0\SDK\API\Management\Types\CustomProviderConfiguration;

class UpdateBrandingPhoneProviderRequestContent extends JsonSerializableType
{
    /**
     * @var ?value-of<PhoneProviderNameEnum> $name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?bool $disabled Whether the provider is enabled (false) or disabled (true).
     */
    #[JsonProperty('disabled')]
    private ?bool $disabled;

    /**
     * @var (
     *    TwilioProviderCredentials
     *   |CustomProviderCredentials
     * )|null $credentials
     */
    #[JsonProperty('credentials'), Union(TwilioProviderCredentials::class, CustomProviderCredentials::class, 'null')]
    private TwilioProviderCredentials|CustomProviderCredentials|null $credentials;

    /**
     * @var (
     *    TwilioProviderConfiguration
     *   |CustomProviderConfiguration
     * )|null $configuration
     */
    #[JsonProperty('configuration'), Union(TwilioProviderConfiguration::class, CustomProviderConfiguration::class, 'null')]
    private TwilioProviderConfiguration|CustomProviderConfiguration|null $configuration;

    /**
     * @param array{
     *   name?: ?value-of<PhoneProviderNameEnum>,
     *   disabled?: ?bool,
     *   credentials?: (
     *    TwilioProviderCredentials
     *   |CustomProviderCredentials
     * )|null,
     *   configuration?: (
     *    TwilioProviderConfiguration
     *   |CustomProviderConfiguration
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->disabled = $values['disabled'] ?? null;
        $this->credentials = $values['credentials'] ?? null;
        $this->configuration = $values['configuration'] ?? null;
    }

    /**
     * @return ?value-of<PhoneProviderNameEnum>
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?value-of<PhoneProviderNameEnum> $value
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
    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    /**
     * @param ?bool $value
     */
    public function setDisabled(?bool $value = null): self
    {
        $this->disabled = $value;
        $this->_setField('disabled');
        return $this;
    }

    /**
     * @return (
     *    TwilioProviderCredentials
     *   |CustomProviderCredentials
     * )|null
     */
    public function getCredentials(): TwilioProviderCredentials|CustomProviderCredentials|null
    {
        return $this->credentials;
    }

    /**
     * @param (
     *    TwilioProviderCredentials
     *   |CustomProviderCredentials
     * )|null $value
     */
    public function setCredentials(TwilioProviderCredentials|CustomProviderCredentials|null $value = null): self
    {
        $this->credentials = $value;
        $this->_setField('credentials');
        return $this;
    }

    /**
     * @return (
     *    TwilioProviderConfiguration
     *   |CustomProviderConfiguration
     * )|null
     */
    public function getConfiguration(): TwilioProviderConfiguration|CustomProviderConfiguration|null
    {
        return $this->configuration;
    }

    /**
     * @param (
     *    TwilioProviderConfiguration
     *   |CustomProviderConfiguration
     * )|null $value
     */
    public function setConfiguration(TwilioProviderConfiguration|CustomProviderConfiguration|null $value = null): self
    {
        $this->configuration = $value;
        $this->_setField('configuration');
        return $this;
    }
}
