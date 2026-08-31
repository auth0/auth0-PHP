<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class NetworkAclKey extends JsonSerializableType
{
    /**
     * @var string $id Generated identifier for the key. Used to reference the key from a Network ACL and to identify it in Tenant Logs.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $name User supplied label for the key.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var value-of<NetworkAclKeyAlgorithmEnum> $alg
     */
    #[JsonProperty('alg')]
    private string $alg;

    /**
     * @var string $fingerprint Fingerprint of the key material, determined by the algorithm specified. Currently only HMAC-SHA256 is supported.
     */
    #[JsonProperty('fingerprint')]
    private string $fingerprint;

    /**
     * @var string $createdAt Time when the key was created.
     */
    #[JsonProperty('created_at')]
    private string $createdAt;

    /**
     * @var string $updatedAt Time when the key was last updated.
     */
    #[JsonProperty('updated_at')]
    private string $updatedAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   alg: value-of<NetworkAclKeyAlgorithmEnum>,
     *   fingerprint: string,
     *   createdAt: string,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->alg = $values['alg'];
        $this->fingerprint = $values['fingerprint'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
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
     * @return value-of<NetworkAclKeyAlgorithmEnum>
     */
    public function getAlg(): string
    {
        return $this->alg;
    }

    /**
     * @param value-of<NetworkAclKeyAlgorithmEnum> $value
     */
    public function setAlg(string $value): self
    {
        $this->alg = $value;
        $this->_setField('alg');
        return $this;
    }

    /**
     * @return string
     */
    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    /**
     * @param string $value
     */
    public function setFingerprint(string $value): self
    {
        $this->fingerprint = $value;
        $this->_setField('fingerprint');
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $value
     */
    public function setCreatedAt(string $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $value
     */
    public function setUpdatedAt(string $value): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
