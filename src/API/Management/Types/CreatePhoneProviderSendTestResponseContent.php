<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreatePhoneProviderSendTestResponseContent extends JsonSerializableType
{
    /**
     * @var ?float $code The status code of the operation.
     */
    #[JsonProperty('code')]
    private ?float $code;

    /**
     * @var ?string $message The description of the operation status.
     */
    #[JsonProperty('message')]
    private ?string $message;

    /**
     * @param array{
     *   code?: ?float,
     *   message?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->code = $values['code'] ?? null;
        $this->message = $values['message'] ?? null;
    }

    /**
     * @return ?float
     */
    public function getCode(): ?float
    {
        return $this->code;
    }

    /**
     * @param ?float $value
     */
    public function setCode(?float $value = null): self
    {
        $this->code = $value;
        $this->_setField('code');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param ?string $value
     */
    public function setMessage(?string $value = null): self
    {
        $this->message = $value;
        $this->_setField('message');
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
