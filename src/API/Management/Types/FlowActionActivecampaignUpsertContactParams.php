<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionActivecampaignUpsertContactParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $email
     */
    #[JsonProperty('email')]
    private string $email;

    /**
     * @var ?string $firstName
     */
    #[JsonProperty('first_name')]
    private ?string $firstName;

    /**
     * @var ?string $lastName
     */
    #[JsonProperty('last_name')]
    private ?string $lastName;

    /**
     * @var ?string $phone
     */
    #[JsonProperty('phone')]
    private ?string $phone;

    /**
     * @var ?array<string, mixed> $customFields
     */
    #[JsonProperty('custom_fields'), ArrayType(['string' => 'mixed'])]
    private ?array $customFields;

    /**
     * @param array{
     *   connectionId: string,
     *   email: string,
     *   firstName?: ?string,
     *   lastName?: ?string,
     *   phone?: ?string,
     *   customFields?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->email = $values['email'];
        $this->firstName = $values['firstName'] ?? null;
        $this->lastName = $values['lastName'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->customFields = $values['customFields'] ?? null;
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $value
     */
    public function setEmail(string $value): self
    {
        $this->email = $value;
        $this->_setField('email');
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
     * @return ?string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param ?string $value
     */
    public function setLastName(?string $value = null): self
    {
        $this->lastName = $value;
        $this->_setField('lastName');
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
    public function getCustomFields(): ?array
    {
        return $this->customFields;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setCustomFields(?array $value = null): self
    {
        $this->customFields = $value;
        $this->_setField('customFields');
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
