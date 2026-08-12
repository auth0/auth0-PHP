<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class IntegrationRelease extends JsonSerializableType
{
    /**
     * @var ?string $id The id of the associated IntegrationRelease
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?ActionTrigger $trigger
     */
    #[JsonProperty('trigger')]
    private ?ActionTrigger $trigger;

    /**
     * @var ?IntegrationSemVer $semver
     */
    #[JsonProperty('semver')]
    private ?IntegrationSemVer $semver;

    /**
     * required_secrets declares all the necessary secrets for an integration to
     * work.
     *
     * @var ?array<IntegrationRequiredParam> $requiredSecrets
     */
    #[JsonProperty('required_secrets'), ArrayType([IntegrationRequiredParam::class])]
    private ?array $requiredSecrets;

    /**
     * @var ?array<IntegrationRequiredParam> $requiredConfiguration required_configuration declares all the necessary configuration fields for an integration to work.
     */
    #[JsonProperty('required_configuration'), ArrayType([IntegrationRequiredParam::class])]
    private ?array $requiredConfiguration;

    /**
     * @param array{
     *   id?: ?string,
     *   trigger?: ?ActionTrigger,
     *   semver?: ?IntegrationSemVer,
     *   requiredSecrets?: ?array<IntegrationRequiredParam>,
     *   requiredConfiguration?: ?array<IntegrationRequiredParam>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->trigger = $values['trigger'] ?? null;
        $this->semver = $values['semver'] ?? null;
        $this->requiredSecrets = $values['requiredSecrets'] ?? null;
        $this->requiredConfiguration = $values['requiredConfiguration'] ?? null;
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
     * @return ?ActionTrigger
     */
    public function getTrigger(): ?ActionTrigger
    {
        return $this->trigger;
    }

    /**
     * @param ?ActionTrigger $value
     */
    public function setTrigger(?ActionTrigger $value = null): self
    {
        $this->trigger = $value;
        $this->_setField('trigger');
        return $this;
    }

    /**
     * @return ?IntegrationSemVer
     */
    public function getSemver(): ?IntegrationSemVer
    {
        return $this->semver;
    }

    /**
     * @param ?IntegrationSemVer $value
     */
    public function setSemver(?IntegrationSemVer $value = null): self
    {
        $this->semver = $value;
        $this->_setField('semver');
        return $this;
    }

    /**
     * @return ?array<IntegrationRequiredParam>
     */
    public function getRequiredSecrets(): ?array
    {
        return $this->requiredSecrets;
    }

    /**
     * @param ?array<IntegrationRequiredParam> $value
     */
    public function setRequiredSecrets(?array $value = null): self
    {
        $this->requiredSecrets = $value;
        $this->_setField('requiredSecrets');
        return $this;
    }

    /**
     * @return ?array<IntegrationRequiredParam>
     */
    public function getRequiredConfiguration(): ?array
    {
        return $this->requiredConfiguration;
    }

    /**
     * @param ?array<IntegrationRequiredParam> $value
     */
    public function setRequiredConfiguration(?array $value = null): self
    {
        $this->requiredConfiguration = $value;
        $this->_setField('requiredConfiguration');
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
