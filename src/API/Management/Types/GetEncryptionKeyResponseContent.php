<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Encryption key
 */
class GetEncryptionKeyResponseContent extends JsonSerializableType
{
    /**
     * @var string $kid Key ID
     */
    #[JsonProperty('kid')]
    private string $kid;

    /**
     * @var value-of<EncryptionKeyType> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var value-of<EncryptionKeyState> $state
     */
    #[JsonProperty('state')]
    private string $state;

    /**
     * @var DateTime $createdAt Key creation timestamp
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt Key update timestamp
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @var ?string $parentKid ID of parent wrapping key
     */
    #[JsonProperty('parent_kid')]
    private ?string $parentKid;

    /**
     * @var ?string $publicKey Public key in PEM format
     */
    #[JsonProperty('public_key')]
    private ?string $publicKey;

    /**
     * @param array{
     *   kid: string,
     *   type: value-of<EncryptionKeyType>,
     *   state: value-of<EncryptionKeyState>,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   parentKid?: ?string,
     *   publicKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->kid = $values['kid'];
        $this->type = $values['type'];
        $this->state = $values['state'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->parentKid = $values['parentKid'] ?? null;
        $this->publicKey = $values['publicKey'] ?? null;
    }

    /**
     * @return string
     */
    public function getKid(): string
    {
        return $this->kid;
    }

    /**
     * @param string $value
     */
    public function setKid(string $value): self
    {
        $this->kid = $value;
        $this->_setField('kid');
        return $this;
    }

    /**
     * @return value-of<EncryptionKeyType>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<EncryptionKeyType> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return value-of<EncryptionKeyState>
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param value-of<EncryptionKeyState> $value
     */
    public function setState(string $value): self
    {
        $this->state = $value;
        $this->_setField('state');
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
    public function getParentKid(): ?string
    {
        return $this->parentKid;
    }

    /**
     * @param ?string $value
     */
    public function setParentKid(?string $value = null): self
    {
        $this->parentKid = $value;
        $this->_setField('parentKid');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPublicKey(): ?string
    {
        return $this->publicKey;
    }

    /**
     * @param ?string $value
     */
    public function setPublicKey(?string $value = null): self
    {
        $this->publicKey = $value;
        $this->_setField('publicKey');
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
