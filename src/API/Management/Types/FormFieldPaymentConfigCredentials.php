<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldPaymentConfigCredentials extends JsonSerializableType
{
    /**
     * @var string $publicKey
     */
    #[JsonProperty('public_key')]
    private string $publicKey;

    /**
     * @var string $privateKey
     */
    #[JsonProperty('private_key')]
    private string $privateKey;

    /**
     * @param array{
     *   publicKey: string,
     *   privateKey: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->publicKey = $values['publicKey'];
        $this->privateKey = $values['privateKey'];
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @param string $value
     */
    public function setPublicKey(string $value): self
    {
        $this->publicKey = $value;
        $this->_setField('publicKey');
        return $this;
    }

    /**
     * @return string
     */
    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * @param string $value
     */
    public function setPrivateKey(string $value): self
    {
        $this->privateKey = $value;
        $this->_setField('privateKey');
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
