<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionStripeUpdateCustomerParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?string $name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $description
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?string $email
     */
    #[JsonProperty('email')]
    private ?string $email;

    /**
     * @var ?string $phone
     */
    #[JsonProperty('phone')]
    private ?string $phone;

    /**
     * @var ?string $taxExempt
     */
    #[JsonProperty('tax_exempt')]
    private ?string $taxExempt;

    /**
     * @var ?FlowActionStripeAddress $address
     */
    #[JsonProperty('address')]
    private ?FlowActionStripeAddress $address;

    /**
     * @var ?array<string, string> $metadata
     */
    #[JsonProperty('metadata'), ArrayType(['string' => 'string'])]
    private ?array $metadata;

    /**
     * @param array{
     *   connectionId: string,
     *   id: string,
     *   name?: ?string,
     *   description?: ?string,
     *   email?: ?string,
     *   phone?: ?string,
     *   taxExempt?: ?string,
     *   address?: ?FlowActionStripeAddress,
     *   metadata?: ?array<string, string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->id = $values['id'];
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->taxExempt = $values['taxExempt'] ?? null;
        $this->address = $values['address'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
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
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param ?string $value
     */
    public function setEmail(?string $value = null): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param ?string $value
     */
    public function setPhone(?string $value = null): self
    {
        $this->phone = $value;
        $this->_setField('phone');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTaxExempt(): ?string
    {
        return $this->taxExempt;
    }

    /**
     * @param ?string $value
     */
    public function setTaxExempt(?string $value = null): self
    {
        $this->taxExempt = $value;
        $this->_setField('taxExempt');
        return $this;
    }

    /**
     * @return ?FlowActionStripeAddress
     */
    public function getAddress(): ?FlowActionStripeAddress
    {
        return $this->address;
    }

    /**
     * @param ?FlowActionStripeAddress $value
     */
    public function setAddress(?FlowActionStripeAddress $value = null): self
    {
        $this->address = $value;
        $this->_setField('address');
        return $this;
    }

    /**
     * @return ?array<string, string>
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setMetadata(?array $value = null): self
    {
        $this->metadata = $value;
        $this->_setField('metadata');
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
