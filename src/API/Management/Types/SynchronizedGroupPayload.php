<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SynchronizedGroupPayload extends JsonSerializableType
{
    /**
     * @var string $id Google Workspace Directory group ID.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?string $name Google Workspace Directory group name.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $email Google Workspace Directory group email.
     */
    #[JsonProperty('email')]
    private ?string $email;

    /**
     * @var ?int $directMembersCount Number of direct members in the Google Workspace Directory group.
     */
    #[JsonProperty('direct_members_count')]
    private ?int $directMembersCount;

    /**
     * @param array{
     *   id: string,
     *   name?: ?string,
     *   email?: ?string,
     *   directMembersCount?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->directMembersCount = $values['directMembersCount'] ?? null;
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
     * @return ?int
     */
    public function getDirectMembersCount(): ?int
    {
        return $this->directMembersCount;
    }

    /**
     * @param ?int $value
     */
    public function setDirectMembersCount(?int $value = null): self
    {
        $this->directMembersCount = $value;
        $this->_setField('directMembersCount');
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
