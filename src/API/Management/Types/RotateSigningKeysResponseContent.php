<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class RotateSigningKeysResponseContent extends JsonSerializableType
{
    /**
     * @var string $cert Next key certificate
     */
    #[JsonProperty('cert')]
    private string $cert;

    /**
     * @var string $kid Next key id
     */
    #[JsonProperty('kid')]
    private string $kid;

    /**
     * @param array{
     *   cert: string,
     *   kid: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cert = $values['cert'];
        $this->kid = $values['kid'];
    }

    /**
     * @return string
     */
    public function getCert(): string
    {
        return $this->cert;
    }

    /**
     * @param string $value
     */
    public function setCert(string $value): self
    {
        $this->cert = $value;
        $this->_setField('cert');
        return $this;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
