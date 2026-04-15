<?php

namespace Auth0\SDK\API\Management\Keys\Encryption\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ImportEncryptionKeyRequestContent extends JsonSerializableType
{
    /**
     * @var string $wrappedKey Base64 encoded ciphertext of key material wrapped by public wrapping key.
     */
    #[JsonProperty('wrapped_key')]
    private string $wrappedKey;

    /**
     * @param array{
     *   wrappedKey: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->wrappedKey = $values['wrappedKey'];
    }

    /**
     * @return string
     */
    public function getWrappedKey(): string
    {
        return $this->wrappedKey;
    }

    /**
     * @param string $value
     */
    public function setWrappedKey(string $value): self
    {
        $this->wrappedKey = $value;
        $this->_setField('wrappedKey');
        return $this;
    }
}
