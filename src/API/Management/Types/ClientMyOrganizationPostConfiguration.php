<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Configuration related to the My Organization Configuration for the client.
 */
class ClientMyOrganizationPostConfiguration extends JsonSerializableType
{
    /**
     * @var ?string $connectionProfileId The connection profile ID that this client should validate against.
     */
    #[JsonProperty('connection_profile_id')]
    private ?string $connectionProfileId;

    /**
     * @var ?string $userAttributeProfileId The user attribute profile ID that this client should validate against.
     */
    #[JsonProperty('user_attribute_profile_id')]
    private ?string $userAttributeProfileId;

    /**
     * @var array<value-of<ClientMyOrganizationConfigurationAllowedStrategiesEnum>> $allowedStrategies The allowed connection strategies for the My Organization Configuration.
     */
    #[JsonProperty('allowed_strategies'), ArrayType(['string'])]
    private array $allowedStrategies;

    /**
     * @var value-of<ClientMyOrganizationDeletionBehaviorEnum> $connectionDeletionBehavior
     */
    #[JsonProperty('connection_deletion_behavior')]
    private string $connectionDeletionBehavior;

    /**
     * @param array{
     *   allowedStrategies: array<value-of<ClientMyOrganizationConfigurationAllowedStrategiesEnum>>,
     *   connectionDeletionBehavior: value-of<ClientMyOrganizationDeletionBehaviorEnum>,
     *   connectionProfileId?: ?string,
     *   userAttributeProfileId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionProfileId = $values['connectionProfileId'] ?? null;
        $this->userAttributeProfileId = $values['userAttributeProfileId'] ?? null;
        $this->allowedStrategies = $values['allowedStrategies'];
        $this->connectionDeletionBehavior = $values['connectionDeletionBehavior'];
    }

    /**
     * @return ?string
     */
    public function getConnectionProfileId(): ?string
    {
        return $this->connectionProfileId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionProfileId(?string $value = null): self
    {
        $this->connectionProfileId = $value;
        $this->_setField('connectionProfileId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserAttributeProfileId(): ?string
    {
        return $this->userAttributeProfileId;
    }

    /**
     * @param ?string $value
     */
    public function setUserAttributeProfileId(?string $value = null): self
    {
        $this->userAttributeProfileId = $value;
        $this->_setField('userAttributeProfileId');
        return $this;
    }

    /**
     * @return array<value-of<ClientMyOrganizationConfigurationAllowedStrategiesEnum>>
     */
    public function getAllowedStrategies(): array
    {
        return $this->allowedStrategies;
    }

    /**
     * @param array<value-of<ClientMyOrganizationConfigurationAllowedStrategiesEnum>> $value
     */
    public function setAllowedStrategies(array $value): self
    {
        $this->allowedStrategies = $value;
        $this->_setField('allowedStrategies');
        return $this;
    }

    /**
     * @return value-of<ClientMyOrganizationDeletionBehaviorEnum>
     */
    public function getConnectionDeletionBehavior(): string
    {
        return $this->connectionDeletionBehavior;
    }

    /**
     * @param value-of<ClientMyOrganizationDeletionBehaviorEnum> $value
     */
    public function setConnectionDeletionBehavior(string $value): self
    {
        $this->connectionDeletionBehavior = $value;
        $this->_setField('connectionDeletionBehavior');
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
