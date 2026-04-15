<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetJobImportUserError extends JsonSerializableType
{
    /**
     * @var ?string $code Error code.
     */
    #[JsonProperty('code')]
    private ?string $code;

    /**
     * @var ?string $message Error message.
     */
    #[JsonProperty('message')]
    private ?string $message;

    /**
     * @var ?string $path Error field.
     */
    #[JsonProperty('path')]
    private ?string $path;

    /**
     * @param array{
     *   code?: ?string,
     *   message?: ?string,
     *   path?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->code = $values['code'] ?? null;
        $this->message = $values['message'] ?? null;
        $this->path = $values['path'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param ?string $value
     */
    public function setCode(?string $value = null): self
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
     * @return ?string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param ?string $value
     */
    public function setPath(?string $value = null): self
    {
        $this->path = $value;
        $this->_setField('path');
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
