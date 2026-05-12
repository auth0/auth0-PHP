<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Too Many Requests
 */
class TooManyRequestsSchema extends JsonSerializableType
{
    /**
     * @var string $message
     */
    #[JsonProperty('message')]
    private string $message;

    /**
     * @var string $statusCode
     */
    #[JsonProperty('statusCode')]
    private string $statusCode;

    /**
     * @var value-of<TooManyRequestsSchemaError> $error
     */
    #[JsonProperty('error')]
    private string $error;

    /**
     * @param array{
     *   message: string,
     *   statusCode: string,
     *   error: value-of<TooManyRequestsSchemaError>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->message = $values['message'];
        $this->statusCode = $values['statusCode'];
        $this->error = $values['error'];
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
    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    /**
     * @param string $value
     */
    public function setStatusCode(string $value): self
    {
        $this->statusCode = $value;
        $this->_setField('statusCode');
        return $this;
    }

    /**
     * @return value-of<TooManyRequestsSchemaError>
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param value-of<TooManyRequestsSchemaError> $value
     */
    public function setError(string $value): self
    {
        $this->error = $value;
        $this->_setField('error');
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
