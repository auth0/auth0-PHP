<?php

namespace Auth0\SDK\API\Management\ClientProfiles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\ClientProfileClientConfiguration;
use Auth0\SDK\API\Management\Types\ClientProfileApplyPolicy;

class CreateClientProfileRequestContent extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ClientProfileClientConfiguration $clientConfiguration
     */
    #[JsonProperty('client_configuration')]
    private ClientProfileClientConfiguration $clientConfiguration;

    /**
     * @var ClientProfileApplyPolicy $applyPolicy
     */
    #[JsonProperty('apply_policy')]
    private ClientProfileApplyPolicy $applyPolicy;

    /**
     * @param array{
     *   name: string,
     *   clientConfiguration: ClientProfileClientConfiguration,
     *   applyPolicy: ClientProfileApplyPolicy,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->clientConfiguration = $values['clientConfiguration'];
        $this->applyPolicy = $values['applyPolicy'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
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
     * @return ClientProfileClientConfiguration
     */
    public function getClientConfiguration(): ClientProfileClientConfiguration
    {
        return $this->clientConfiguration;
    }

    /**
     * @param ClientProfileClientConfiguration $value
     */
    public function setClientConfiguration(ClientProfileClientConfiguration $value): self
    {
        $this->clientConfiguration = $value;
        $this->_setField('clientConfiguration');
        return $this;
    }

    /**
     * @return ClientProfileApplyPolicy
     */
    public function getApplyPolicy(): ClientProfileApplyPolicy
    {
        return $this->applyPolicy;
    }

    /**
     * @param ClientProfileApplyPolicy $value
     */
    public function setApplyPolicy(ClientProfileApplyPolicy $value): self
    {
        $this->applyPolicy = $value;
        $this->_setField('applyPolicy');
        return $this;
    }
}
