<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class FormSummary extends JsonSerializableType
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
     * @var DateTime $createdAt
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @var ?string $embeddedAt
     */
    #[JsonProperty('embedded_at')]
    private ?string $embeddedAt;

    /**
     * @var ?string $submittedAt
     */
    #[JsonProperty('submitted_at')]
    private ?string $submittedAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   embeddedAt?: ?string,
     *   submittedAt?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->embeddedAt = $values['embeddedAt'] ?? null;
        $this->submittedAt = $values['submittedAt'] ?? null;
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
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEmbeddedAt(): ?string
    {
        return $this->embeddedAt;
    }

    /**
     * @param ?string $value
     */
    public function setEmbeddedAt(?string $value = null): self
    {
        $this->embeddedAt = $value;
        $this->_setField('embeddedAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSubmittedAt(): ?string
    {
        return $this->submittedAt;
    }

    /**
     * @param ?string $value
     */
    public function setSubmittedAt(?string $value = null): self
    {
        $this->submittedAt = $value;
        $this->_setField('submittedAt');
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
