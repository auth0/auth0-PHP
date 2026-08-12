<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class TestCustomDomainResponseContent extends JsonSerializableType
{
    /**
     * @var bool $success Result of the operation.
     */
    #[JsonProperty('success')]
    private bool $success;

    /**
     * @var ?string $message Message describing the operation status.
     */
    #[JsonProperty('message')]
    private ?string $message;

    /**
     * @param array{
     *   success: bool,
     *   message?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->success = $values['success'];
        $this->message = $values['message'] ?? null;
    }

    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $value
     */
    public function setSuccess(bool $value): self
    {
        $this->success = $value;
        $this->_setField('success');
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
