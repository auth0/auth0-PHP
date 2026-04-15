<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionSalesforceCreateLeadParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var ?string $firstName
     */
    #[JsonProperty('first_name')]
    private ?string $firstName;

    /**
     * @var string $lastName
     */
    #[JsonProperty('last_name')]
    private string $lastName;

    /**
     * @var string $company
     */
    #[JsonProperty('company')]
    private string $company;

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
     * @var ?array<string, mixed> $payload
     */
    #[JsonProperty('payload'), ArrayType(['string' => 'mixed'])]
    private ?array $payload;

    /**
     * @param array{
     *   connectionId: string,
     *   lastName: string,
     *   company: string,
     *   firstName?: ?string,
     *   email?: ?string,
     *   phone?: ?string,
     *   payload?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->firstName = $values['firstName'] ?? null;
        $this->lastName = $values['lastName'];
        $this->company = $values['company'];
        $this->email = $values['email'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->payload = $values['payload'] ?? null;
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
     * @return ?string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param ?string $value
     */
    public function setFirstName(?string $value = null): self
    {
        $this->firstName = $value;
        $this->_setField('firstName');
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $value
     */
    public function setLastName(string $value): self
    {
        $this->lastName = $value;
        $this->_setField('lastName');
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $value
     */
    public function setCompany(string $value): self
    {
        $this->company = $value;
        $this->_setField('company');
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
     * @return ?array<string, mixed>
     */
    public function getPayload(): ?array
    {
        return $this->payload;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setPayload(?array $value = null): self
    {
        $this->payload = $value;
        $this->_setField('payload');
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
