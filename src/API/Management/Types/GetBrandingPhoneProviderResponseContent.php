<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Phone provider configuration schema
 */
class GetBrandingPhoneProviderResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $tenant The name of the tenant
     */
    #[JsonProperty('tenant')]
    private ?string $tenant;

    /**
     * @var value-of<PhoneProviderNameEnum> $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?value-of<PhoneProviderChannelEnum> $channel
     */
    #[JsonProperty('channel')]
    private ?string $channel;

    /**
     * @var ?bool $disabled Whether the provider is enabled (false) or disabled (true).
     */
    #[JsonProperty('disabled')]
    private ?bool $disabled;

    /**
     * @var (
     *    TwilioProviderConfiguration
     *   |CustomProviderConfiguration
     * )|null $configuration
     */
    #[JsonProperty('configuration'), Union(TwilioProviderConfiguration::class, CustomProviderConfiguration::class, 'null')]
    private TwilioProviderConfiguration|CustomProviderConfiguration|null $configuration;

    /**
     * @var ?DateTime $createdAt The provider's creation date and time in ISO 8601 format
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The date and time of the last update to the provider in ISO 8601 format
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   name: value-of<PhoneProviderNameEnum>,
     *   id?: ?string,
     *   tenant?: ?string,
     *   channel?: ?value-of<PhoneProviderChannelEnum>,
     *   disabled?: ?bool,
     *   configuration?: (
     *    TwilioProviderConfiguration
     *   |CustomProviderConfiguration
     * )|null,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'] ?? null;
        $this->tenant = $values['tenant'] ?? null;
        $this->name = $values['name'];
        $this->channel = $values['channel'] ?? null;
        $this->disabled = $values['disabled'] ?? null;
        $this->configuration = $values['configuration'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    /**
     * @param ?string $value
     */
    public function setTenant(?string $value = null): self
    {
        $this->tenant = $value;
        $this->_setField('tenant');
        return $this;
    }

    /**
     * @return value-of<PhoneProviderNameEnum>
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param value-of<PhoneProviderNameEnum> $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?value-of<PhoneProviderChannelEnum>
     */
    public function getChannel(): ?string
    {
        return $this->channel;
    }

    /**
     * @param ?value-of<PhoneProviderChannelEnum> $value
     */
    public function setChannel(?string $value = null): self
    {
        $this->channel = $value;
        $this->_setField('channel');
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

    /**
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setUpdatedAt(?DateTime $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
