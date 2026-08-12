<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetUserAttributeProfileResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?UserAttributeProfileUserId $userId
     */
    #[JsonProperty('user_id')]
    private ?UserAttributeProfileUserId $userId;

    /**
     * @var ?array<string, UserAttributeProfileUserAttributeAdditionalProperties> $userAttributes
     */
    #[JsonProperty('user_attributes'), ArrayType(['string' => UserAttributeProfileUserAttributeAdditionalProperties::class])]
    private ?array $userAttributes;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   userId?: ?UserAttributeProfileUserId,
     *   userAttributes?: ?array<string, UserAttributeProfileUserAttributeAdditionalProperties>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->userAttributes = $values['userAttributes'] ?? null;
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
     * @return ?UserAttributeProfileUserId
     */
    public function getUserId(): ?UserAttributeProfileUserId
    {
        return $this->userId;
    }

    /**
     * @param ?UserAttributeProfileUserId $value
     */
    public function setUserId(?UserAttributeProfileUserId $value = null): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return ?array<string, UserAttributeProfileUserAttributeAdditionalProperties>
     */
    public function getUserAttributes(): ?array
    {
        return $this->userAttributes;
    }

    /**
     * @param ?array<string, UserAttributeProfileUserAttributeAdditionalProperties> $value
     */
    public function setUserAttributes(?array $value = null): self
    {
        $this->userAttributes = $value;
        $this->_setField('userAttributes');
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
