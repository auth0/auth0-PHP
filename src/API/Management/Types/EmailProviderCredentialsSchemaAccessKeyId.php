<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class EmailProviderCredentialsSchemaAccessKeyId extends JsonSerializableType
{
    /**
     * @var ?string $accessKeyId AWS Access Key ID.
     */
    #[JsonProperty('accessKeyId')]
    private ?string $accessKeyId;

    /**
     * @var ?string $secretAccessKey AWS Secret Access Key.
     */
    #[JsonProperty('secretAccessKey')]
    private ?string $secretAccessKey;

    /**
     * @var ?string $region AWS region.
     */
    #[JsonProperty('region')]
    private ?string $region;

    /**
     * @param array{
     *   accessKeyId?: ?string,
     *   secretAccessKey?: ?string,
     *   region?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accessKeyId = $values['accessKeyId'] ?? null;
        $this->secretAccessKey = $values['secretAccessKey'] ?? null;
        $this->region = $values['region'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAccessKeyId(): ?string
    {
        return $this->accessKeyId;
    }

    /**
     * @param ?string $value
     */
    public function setAccessKeyId(?string $value = null): self
    {
        $this->accessKeyId = $value;
        $this->_setField('accessKeyId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSecretAccessKey(): ?string
    {
        return $this->secretAccessKey;
    }

    /**
     * @param ?string $value
     */
    public function setSecretAccessKey(?string $value = null): self
    {
        $this->secretAccessKey = $value;
        $this->_setField('secretAccessKey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param ?string $value
     */
    public function setRegion(?string $value = null): self
    {
        $this->region = $value;
        $this->_setField('region');
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
