<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class ClientProfile extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

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
     * @var ?DateTime $createdAt Timestamp of creation.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt Timestamp of last update.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   clientConfiguration: ClientProfileClientConfiguration,
     *   applyPolicy: ClientProfileApplyPolicy,
     *   description?: ?string,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->clientConfiguration = $values['clientConfiguration'];
        $this->applyPolicy = $values['applyPolicy'];
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
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
