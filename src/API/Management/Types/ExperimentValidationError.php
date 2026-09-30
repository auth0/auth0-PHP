<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ExperimentValidationError extends JsonSerializableType
{
    /**
     * @var string $code Machine-readable error code identifying the validation failure.
     */
    #[JsonProperty('code')]
    private string $code;

    /**
     * @var string $message Human-readable description of the validation failure.
     */
    #[JsonProperty('message')]
    private string $message;

    /**
     * @param array{
     *   code: string,
     *   message: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->code = $values['code'];
        $this->message = $values['message'];
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $value
     */
    public function setCode(string $value): self
    {
        $this->code = $value;
        $this->_setField('code');
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $value
     */
    public function setMessage(string $value): self
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
