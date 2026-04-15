<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateVerificationEmailResponseContent extends JsonSerializableType
{
    /**
     * @var string $status Status of this job.
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @var string $type Type of job this is.
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var ?string $createdAt When this job was created.
     */
    #[JsonProperty('created_at')]
    private ?string $createdAt;

    /**
     * @var string $id ID of this job.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @param array{
     *   status: string,
     *   type: string,
     *   id: string,
     *   createdAt?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
        $this->type = $values['type'];
        $this->createdAt = $values['createdAt'] ?? null;
        $this->id = $values['id'];
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param ?string $value
     */
    public function setCreatedAt(?string $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
