<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class FlowActionOtpVerifyCodeParams extends JsonSerializableType
{
    /**
     * @var string $reference
     */
    #[JsonProperty('reference')]
    private string $reference;

    /**
     * @var (
     *    int
     *   |string
     * ) $code
     */
    #[JsonProperty('code'), Union('integer', 'string')]
    private int|string $code;

    /**
     * @param array{
     *   reference: string,
     *   code: (
     *    int
     *   |string
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->reference = $values['reference'];
        $this->code = $values['code'];
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
     * @return (
     *    int
     *   |string
     * )
     */
    public function getCode(): int|string
    {
        return $this->code;
    }

    /**
     * @param (
     *    int
     *   |string
     * ) $value
     */
    public function setCode(int|string $value): self
    {
        $this->code = $value;
        $this->_setField('code');
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
