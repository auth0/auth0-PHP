<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class LogStreamHttpSink extends JsonSerializableType
{
    /**
     * @var ?string $httpAuthorization HTTP Authorization header
     */
    #[JsonProperty('httpAuthorization')]
    private ?string $httpAuthorization;

    /**
     * @var ?value-of<LogStreamHttpContentFormatEnum> $httpContentFormat
     */
    #[JsonProperty('httpContentFormat')]
    private ?string $httpContentFormat;

    /**
     * @var ?string $httpContentType HTTP Content-Type header
     */
    #[JsonProperty('httpContentType')]
    private ?string $httpContentType;

    /**
     * @var string $httpEndpoint HTTP endpoint
     */
    #[JsonProperty('httpEndpoint')]
    private string $httpEndpoint;

    /**
     * @var ?array<HttpCustomHeader> $httpCustomHeaders custom HTTP headers
     */
    #[JsonProperty('httpCustomHeaders'), ArrayType([HttpCustomHeader::class])]
    private ?array $httpCustomHeaders;

    /**
     * @param array{
     *   httpEndpoint: string,
     *   httpAuthorization?: ?string,
     *   httpContentFormat?: ?value-of<LogStreamHttpContentFormatEnum>,
     *   httpContentType?: ?string,
     *   httpCustomHeaders?: ?array<HttpCustomHeader>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->httpAuthorization = $values['httpAuthorization'] ?? null;
        $this->httpContentFormat = $values['httpContentFormat'] ?? null;
        $this->httpContentType = $values['httpContentType'] ?? null;
        $this->httpEndpoint = $values['httpEndpoint'];
        $this->httpCustomHeaders = $values['httpCustomHeaders'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getHttpAuthorization(): ?string
    {
        return $this->httpAuthorization;
    }

    /**
     * @param ?string $value
     */
    public function setHttpAuthorization(?string $value = null): self
    {
        $this->httpAuthorization = $value;
        $this->_setField('httpAuthorization');
        return $this;
    }

    /**
     * @return ?value-of<LogStreamHttpContentFormatEnum>
     */
    public function getHttpContentFormat(): ?string
    {
        return $this->httpContentFormat;
    }

    /**
     * @param ?value-of<LogStreamHttpContentFormatEnum> $value
     */
    public function setHttpContentFormat(?string $value = null): self
    {
        $this->httpContentFormat = $value;
        $this->_setField('httpContentFormat');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getHttpContentType(): ?string
    {
        return $this->httpContentType;
    }

    /**
     * @param ?string $value
     */
    public function setHttpContentType(?string $value = null): self
    {
        $this->httpContentType = $value;
        $this->_setField('httpContentType');
        return $this;
    }

    /**
     * @return string
     */
    public function getHttpEndpoint(): string
    {
        return $this->httpEndpoint;
    }

    /**
     * @param string $value
     */
    public function setHttpEndpoint(string $value): self
    {
        $this->httpEndpoint = $value;
        $this->_setField('httpEndpoint');
        return $this;
    }

    /**
     * @return ?array<HttpCustomHeader>
     */
    public function getHttpCustomHeaders(): ?array
    {
        return $this->httpCustomHeaders;
    }

    /**
     * @param ?array<HttpCustomHeader> $value
     */
    public function setHttpCustomHeaders(?array $value = null): self
    {
        $this->httpCustomHeaders = $value;
        $this->_setField('httpCustomHeaders');
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
