<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class RotateConnectionKeysRequestContent extends JsonSerializableType
{
    /**
     * @var ?value-of<RotateConnectionKeysSigningAlgEnum> $signingAlg
     */
    #[JsonProperty('signing_alg')]
    private ?string $signingAlg;

    /**
     * @param array{
     *   signingAlg?: ?value-of<RotateConnectionKeysSigningAlgEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->signingAlg = $values['signingAlg'] ?? null;
    }

    /**
     * @return ?value-of<RotateConnectionKeysSigningAlgEnum>
     */
    public function getSigningAlg(): ?string
    {
        return $this->signingAlg;
    }

    /**
     * @param ?value-of<RotateConnectionKeysSigningAlgEnum> $value
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
