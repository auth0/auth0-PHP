<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ResourceServerTokenEncryption extends JsonSerializableType
{
    /**
     * @var value-of<ResourceServerTokenEncryptionFormatEnum> $format
     */
    #[JsonProperty('format')]
    private string $format;

    /**
     * @var ResourceServerTokenEncryptionKey $encryptionKey
     */
    #[JsonProperty('encryption_key')]
    private ResourceServerTokenEncryptionKey $encryptionKey;

    /**
     * @param array{
     *   format: value-of<ResourceServerTokenEncryptionFormatEnum>,
     *   encryptionKey: ResourceServerTokenEncryptionKey,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->format = $values['format'];
        $this->encryptionKey = $values['encryptionKey'];
    }

    /**
     * @return value-of<ResourceServerTokenEncryptionFormatEnum>
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param value-of<ResourceServerTokenEncryptionFormatEnum> $value
     */
    public function setFormat(string $value): self
    {
        $this->format = $value;
        $this->_setField('format');
        return $this;
    }

    /**
     * @return ResourceServerTokenEncryptionKey
     */
    public function getEncryptionKey(): ResourceServerTokenEncryptionKey
    {
        return $this->encryptionKey;
    }

    /**
     * @param ResourceServerTokenEncryptionKey $value
     */
    public function setEncryptionKey(ResourceServerTokenEncryptionKey $value): self
    {
        $this->encryptionKey = $value;
        $this->_setField('encryptionKey');
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
