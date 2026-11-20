<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PostConnectionKeysRequestContent extends JsonSerializableType
{
    /**
     * @var ?value-of<ConnectionKeyUseEnum> $keyUse Whether to provision a signing key (default) or an encryption key for the connection.
     */
    #[JsonProperty('key_use')]
    private ?string $keyUse;

    /**
     * @var ?value-of<PostConnectionKeysAlgEnum> $signingAlg
     */
    #[JsonProperty('signing_alg')]
    private ?string $signingAlg;

    /**
     * @param array{
     *   keyUse?: ?value-of<ConnectionKeyUseEnum>,
     *   signingAlg?: ?value-of<PostConnectionKeysAlgEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->keyUse = $values['keyUse'] ?? null;
        $this->signingAlg = $values['signingAlg'] ?? null;
    }

    /**
     * @return ?value-of<ConnectionKeyUseEnum>
     */
    public function getKeyUse(): ?string
    {
        return $this->keyUse;
    }

    /**
     * @param ?value-of<ConnectionKeyUseEnum> $value
     */
    public function setKeyUse(?string $value = null): self
    {
        $this->keyUse = $value;
        $this->_setField('keyUse');
        return $this;
    }

    /**
     * @return ?value-of<PostConnectionKeysAlgEnum>
     */
    public function getSigningAlg(): ?string
    {
        return $this->signingAlg;
    }

    /**
     * @param ?value-of<PostConnectionKeysAlgEnum> $value
     */
    public function setSigningAlg(?string $value = null): self
    {
        $this->signingAlg = $value;
        $this->_setField('signingAlg');
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
