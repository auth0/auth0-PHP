<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ResourceServerTokenEncryptionKey extends JsonSerializableType
{
    /**
     * @var ?string $name Name of the encryption key.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var value-of<ResourceServerTokenEncryptionAlgorithmEnum> $alg
     */
    #[JsonProperty('alg')]
    private string $alg;

    /**
     * @var ?string $kid Key ID.
     */
    #[JsonProperty('kid')]
    private ?string $kid;

    /**
     * @var string $pem PEM-formatted public key. Must be JSON escaped.
     */
    #[JsonProperty('pem')]
    private string $pem;

    /**
     * @param array{
     *   alg: value-of<ResourceServerTokenEncryptionAlgorithmEnum>,
     *   pem: string,
     *   name?: ?string,
     *   kid?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'] ?? null;
        $this->alg = $values['alg'];
        $this->kid = $values['kid'] ?? null;
        $this->pem = $values['pem'];
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
     * @return value-of<ResourceServerTokenEncryptionAlgorithmEnum>
     */
    public function getAlg(): string
    {
        return $this->alg;
    }

    /**
     * @param value-of<ResourceServerTokenEncryptionAlgorithmEnum> $value
     */
    public function setAlg(string $value): self
    {
        $this->alg = $value;
        $this->_setField('alg');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getKid(): ?string
    {
        return $this->kid;
    }

    /**
     * @param ?string $value
     */
    public function setKid(?string $value = null): self
    {
        $this->kid = $value;
        $this->_setField('kid');
        return $this;
    }

    /**
     * @return string
     */
    public function getPem(): string
    {
        return $this->pem;
    }

    /**
     * @param string $value
     */
    public function setPem(string $value): self
    {
        $this->pem = $value;
        $this->_setField('pem');
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
