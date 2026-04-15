<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class RoleUser extends JsonSerializableType
{
    /**
     * @var ?string $userId ID of this user.
     */
    #[JsonProperty('user_id')]
    private ?string $userId;

    /**
     * @var ?string $picture URL to a picture for this user.
     */
    #[JsonProperty('picture')]
    private ?string $picture;

    /**
     * @var ?string $name Name of this user.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $email Email address of this user.
     */
    #[JsonProperty('email')]
    private ?string $email;

    /**
     * @param array{
     *   userId?: ?string,
     *   picture?: ?string,
     *   name?: ?string,
     *   email?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->userId = $values['userId'] ?? null;
        $this->picture = $values['picture'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->email = $values['email'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param ?string $value
     */
    public function setUserId(?string $value = null): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param ?string $value
     */
    public function setPicture(?string $value = null): self
    {
        $this->picture = $value;
        $this->_setField('picture');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
