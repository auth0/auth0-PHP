<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionOtpGenerateCodeParams extends JsonSerializableType
{
    /**
     * @var string $reference
     */
    #[JsonProperty('reference')]
    private string $reference;

    /**
     * @var int $length
     */
    #[JsonProperty('length')]
    private int $length;

    /**
     * @param array{
     *   reference: string,
     *   length: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->reference = $values['reference'];
        $this->length = $values['length'];
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $value
     */
    public function setReference(string $value): self
    {
        $this->reference = $value;
        $this->_setField('reference');
        return $this;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $value
     */
    public function setLength(int $value): self
    {
        $this->length = $value;
        $this->_setField('length');
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
