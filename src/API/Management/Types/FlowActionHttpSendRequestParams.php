<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class FlowActionHttpSendRequestParams extends JsonSerializableType
{
    /**
     * @var ?string $connectionId
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @var string $url
     */
    #[JsonProperty('url')]
    private string $url;

    /**
     * @var ?value-of<FlowActionHttpSendRequestParamsMethod> $method
     */
    #[JsonProperty('method')]
    private ?string $method;

    /**
     * @var ?array<string, mixed> $headers
     */
    #[JsonProperty('headers'), ArrayType(['string' => 'mixed'])]
    private ?array $headers;

    /**
     * @var ?FlowActionHttpSendRequestParamsBasicAuth $basic
     */
    #[JsonProperty('basic')]
    private ?FlowActionHttpSendRequestParamsBasicAuth $basic;

    /**
     * @var ?array<string, (
     *    float
     *   |string
     * )|null> $params
     */
    #[JsonProperty('params'), ArrayType(['string' => new Union(new Union('float', 'string'), 'null')])]
    private ?array $params;

    /**
     * @var (
     *    string
     *   |array<mixed>
     *   |array<string, mixed>
     * )|null $payload
     */
    #[JsonProperty('payload'), Union('string', ['mixed'], ['string' => 'mixed'], 'null')]
    private string|array|null $payload;

    /**
     * @var ?value-of<FlowActionHttpSendRequestParamsContentType> $contentType
     */
    #[JsonProperty('content_type')]
    private ?string $contentType;

    /**
     * @param array{
     *   url: string,
     *   connectionId?: ?string,
     *   method?: ?value-of<FlowActionHttpSendRequestParamsMethod>,
     *   headers?: ?array<string, mixed>,
     *   basic?: ?FlowActionHttpSendRequestParamsBasicAuth,
     *   params?: ?array<string, (
     *    float
     *   |string
     * )|null>,
     *   payload?: (
     *    string
     *   |array<mixed>
     *   |array<string, mixed>
     * )|null,
     *   contentType?: ?value-of<FlowActionHttpSendRequestParamsContentType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'] ?? null;
        $this->url = $values['url'];
        $this->method = $values['method'] ?? null;
        $this->headers = $values['headers'] ?? null;
        $this->basic = $values['basic'] ?? null;
        $this->params = $values['params'] ?? null;
        $this->payload = $values['payload'] ?? null;
        $this->contentType = $values['contentType'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $value
     */
    public function setUrl(string $value): self
    {
        $this->url = $value;
        $this->_setField('url');
        return $this;
    }

    /**
     * @return ?value-of<FlowActionHttpSendRequestParamsMethod>
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param ?value-of<FlowActionHttpSendRequestParamsMethod> $value
     */
    public function setMethod(?string $value = null): self
    {
        $this->method = $value;
        $this->_setField('method');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setHeaders(?array $value = null): self
    {
        $this->headers = $value;
        $this->_setField('headers');
        return $this;
    }

    /**
     * @return ?FlowActionHttpSendRequestParamsBasicAuth
     */
    public function getBasic(): ?FlowActionHttpSendRequestParamsBasicAuth
    {
        return $this->basic;
    }

    /**
     * @param ?FlowActionHttpSendRequestParamsBasicAuth $value
     */
    public function setBasic(?FlowActionHttpSendRequestParamsBasicAuth $value = null): self
    {
        $this->basic = $value;
        $this->_setField('basic');
        return $this;
    }

    /**
     * @return ?array<string, (
     *    float
     *   |string
     * )|null>
     */
    public function getParams(): ?array
    {
        return $this->params;
    }

    /**
     * @param ?array<string, (
     *    float
     *   |string
     * )|null> $value
     */
    public function setParams(?array $value = null): self
    {
        $this->params = $value;
        $this->_setField('params');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |array<mixed>
     *   |array<string, mixed>
     * )|null
     */
    public function getPayload(): string|array|null
    {
        return $this->payload;
    }

    /**
     * @param (
     *    string
     *   |array<mixed>
     *   |array<string, mixed>
     * )|null $value
     */
    public function setPayload(string|array|null $value = null): self
    {
        $this->payload = $value;
        $this->_setField('payload');
        return $this;
    }

    /**
     * @return ?value-of<FlowActionHttpSendRequestParamsContentType>
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * @param ?value-of<FlowActionHttpSendRequestParamsContentType> $value
     */
    public function setContentType(?string $value = null): self
    {
        $this->contentType = $value;
        $this->_setField('contentType');
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
