<?php

namespace Auth0\SDK\API\Management\UserAttributeProfiles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\UserAttributeProfileUserId;
use Auth0\SDK\API\Management\Types\UserAttributeProfileUserAttributeAdditionalProperties;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateUserAttributeProfileRequestContent extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?UserAttributeProfileUserId $userId
     */
    #[JsonProperty('user_id')]
    private ?UserAttributeProfileUserId $userId;

    /**
     * @var array<string, UserAttributeProfileUserAttributeAdditionalProperties> $userAttributes
     */
    #[JsonProperty('user_attributes'), ArrayType(['string' => UserAttributeProfileUserAttributeAdditionalProperties::class])]
    private array $userAttributes;

    /**
     * @param array{
     *   name: string,
     *   userAttributes: array<string, UserAttributeProfileUserAttributeAdditionalProperties>,
     *   userId?: ?UserAttributeProfileUserId,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->userId = $values['userId'] ?? null;
        $this->userAttributes = $values['userAttributes'];
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
     * @return array<string, UserAttributeProfileUserAttributeAdditionalProperties>
     */
    public function getUserAttributes(): array
    {
        return $this->userAttributes;
    }

    /**
     * @param array<string, UserAttributeProfileUserAttributeAdditionalProperties> $value
     */
    public function setUserAttributes(array $value): self
    {
        $this->userAttributes = $value;
        $this->_setField('userAttributes');
        return $this;
    }
}
