<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * JWK representing a custom public signing key.
 */
class CustomSigningKeyJwk extends JsonSerializableType
{
    /**
     * @var value-of<CustomSigningKeyTypeEnum> $kty
     */
    #[JsonProperty('kty')]
    private string $kty;

    /**
     * @var ?string $kid Key identifier
     */
    #[JsonProperty('kid')]
    private ?string $kid;

    /**
     * @var ?value-of<CustomSigningKeyUseEnum> $use
     */
    #[JsonProperty('use')]
    private ?string $use;

    /**
     * @var ?array<value-of<CustomSigningKeyOperationEnum>> $keyOps Key operations
     */
    #[JsonProperty('key_ops'), ArrayType(['string'])]
    private ?array $keyOps;

    /**
     * @var ?value-of<CustomSigningKeyAlgorithmEnum> $alg
     */
    #[JsonProperty('alg')]
    private ?string $alg;

    /**
     * @var ?string $n Key modulus
     */
    #[JsonProperty('n')]
    private ?string $n;

    /**
     * @var ?string $e Key exponent
     */
    #[JsonProperty('e')]
    private ?string $e;

    /**
     * @var ?value-of<CustomSigningKeyCurveEnum> $crv
     */
    #[JsonProperty('crv')]
    private ?string $crv;

    /**
     * @var ?string $x X coordinate
     */
    #[JsonProperty('x')]
    private ?string $x;

    /**
     * @var ?string $y Y coordinate
     */
    #[JsonProperty('y')]
    private ?string $y;

    /**
     * @var ?string $x5U X.509 URL
     */
    #[JsonProperty('x5u')]
    private ?string $x5U;

    /**
     * @var ?array<string> $x5C X.509 certificate chain
     */
    #[JsonProperty('x5c'), ArrayType(['string'])]
    private ?array $x5C;

    /**
     * @var ?string $x5T X.509 certificate SHA-1 thumbprint
     */
    #[JsonProperty('x5t')]
    private ?string $x5T;

    /**
     * @var ?string $x5TS256 X.509 certificate SHA-256 thumbprint
     */
    #[JsonProperty('x5t#S256')]
    private ?string $x5TS256;

    /**
     * @param array{
     *   kty: value-of<CustomSigningKeyTypeEnum>,
     *   kid?: ?string,
     *   use?: ?value-of<CustomSigningKeyUseEnum>,
     *   keyOps?: ?array<value-of<CustomSigningKeyOperationEnum>>,
     *   alg?: ?value-of<CustomSigningKeyAlgorithmEnum>,
     *   n?: ?string,
     *   e?: ?string,
     *   crv?: ?value-of<CustomSigningKeyCurveEnum>,
     *   x?: ?string,
     *   y?: ?string,
     *   x5U?: ?string,
     *   x5C?: ?array<string>,
     *   x5T?: ?string,
     *   x5TS256?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->kty = $values['kty'];
        $this->kid = $values['kid'] ?? null;
        $this->use = $values['use'] ?? null;
        $this->keyOps = $values['keyOps'] ?? null;
        $this->alg = $values['alg'] ?? null;
        $this->n = $values['n'] ?? null;
        $this->e = $values['e'] ?? null;
        $this->crv = $values['crv'] ?? null;
        $this->x = $values['x'] ?? null;
        $this->y = $values['y'] ?? null;
        $this->x5U = $values['x5U'] ?? null;
        $this->x5C = $values['x5C'] ?? null;
        $this->x5T = $values['x5T'] ?? null;
        $this->x5TS256 = $values['x5TS256'] ?? null;
    }

    /**
     * @return value-of<CustomSigningKeyTypeEnum>
     */
    public function getKty(): string
    {
        return $this->kty;
    }

    /**
     * @param value-of<CustomSigningKeyTypeEnum> $value
     */
    public function setKty(string $value): self
    {
        $this->kty = $value;
        $this->_setField('kty');
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
     * @return ?value-of<CustomSigningKeyUseEnum>
     */
    public function getUse(): ?string
    {
        return $this->use;
    }

    /**
     * @param ?value-of<CustomSigningKeyUseEnum> $value
     */
    public function setUse(?string $value = null): self
    {
        $this->use = $value;
        $this->_setField('use');
        return $this;
    }

    /**
     * @return ?array<value-of<CustomSigningKeyOperationEnum>>
     */
    public function getKeyOps(): ?array
    {
        return $this->keyOps;
    }

    /**
     * @param ?array<value-of<CustomSigningKeyOperationEnum>> $value
     */
    public function setKeyOps(?array $value = null): self
    {
        $this->keyOps = $value;
        $this->_setField('keyOps');
        return $this;
    }

    /**
     * @return ?value-of<CustomSigningKeyAlgorithmEnum>
     */
    public function getAlg(): ?string
    {
        return $this->alg;
    }

    /**
     * @param ?value-of<CustomSigningKeyAlgorithmEnum> $value
     */
    public function setAlg(?string $value = null): self
    {
        $this->alg = $value;
        $this->_setField('alg');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getN(): ?string
    {
        return $this->n;
    }

    /**
     * @param ?string $value
     */
    public function setN(?string $value = null): self
    {
        $this->n = $value;
        $this->_setField('n');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getE(): ?string
    {
        return $this->e;
    }

    /**
     * @param ?string $value
     */
    public function setE(?string $value = null): self
    {
        $this->e = $value;
        $this->_setField('e');
        return $this;
    }

    /**
     * @return ?value-of<CustomSigningKeyCurveEnum>
     */
    public function getCrv(): ?string
    {
        return $this->crv;
    }

    /**
     * @param ?value-of<CustomSigningKeyCurveEnum> $value
     */
    public function setCrv(?string $value = null): self
    {
        $this->crv = $value;
        $this->_setField('crv');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getX(): ?string
    {
        return $this->x;
    }

    /**
     * @param ?string $value
     */
    public function setX(?string $value = null): self
    {
        $this->x = $value;
        $this->_setField('x');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getY(): ?string
    {
        return $this->y;
    }

    /**
     * @param ?string $value
     */
    public function setY(?string $value = null): self
    {
        $this->y = $value;
        $this->_setField('y');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getX5U(): ?string
    {
        return $this->x5U;
    }

    /**
     * @param ?string $value
     */
    public function setX5U(?string $value = null): self
    {
        $this->x5U = $value;
        $this->_setField('x5U');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getX5C(): ?array
    {
        return $this->x5C;
    }

    /**
     * @param ?array<string> $value
     */
    public function setX5C(?array $value = null): self
    {
        $this->x5C = $value;
        $this->_setField('x5C');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getX5T(): ?string
    {
        return $this->x5T;
    }

    /**
     * @param ?string $value
     */
    public function setX5T(?string $value = null): self
    {
        $this->x5T = $value;
        $this->_setField('x5T');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getX5TS256(): ?string
    {
        return $this->x5TS256;
    }

    /**
     * @param ?string $value
     */
    public function setX5TS256(?string $value = null): self
    {
        $this->x5TS256 = $value;
        $this->_setField('x5TS256');
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
