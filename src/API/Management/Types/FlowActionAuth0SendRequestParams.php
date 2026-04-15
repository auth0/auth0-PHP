<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class FlowActionAuth0SendRequestParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $pathname
     */
    #[JsonProperty('pathname')]
    private string $pathname;

    /**
     * @var ?value-of<FlowActionAuth0SendRequestParamsMethod> $method
     */
    #[JsonProperty('method')]
    private ?string $method;

    /**
     * @var ?array<string, mixed> $headers
     */
    #[JsonProperty('headers'), ArrayType(['string' => 'mixed'])]
    private ?array $headers;

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
     * @param array{
     *   connectionId: string,
     *   pathname: string,
     *   method?: ?value-of<FlowActionAuth0SendRequestParamsMethod>,
     *   headers?: ?array<string, mixed>,
     *   params?: ?array<string, (
     *    float
     *   |string
     * )|null>,
     *   payload?: (
     *    string
     *   |array<mixed>
     *   |array<string, mixed>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->pathname = $values['pathname'];
        $this->method = $values['method'] ?? null;
        $this->headers = $values['headers'] ?? null;
        $this->params = $values['params'] ?? null;
        $this->payload = $values['payload'] ?? null;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getPathname(): string
    {
        return $this->pathname;
    }

    /**
     * @param string $value
     */
    public function setPathname(string $value): self
    {
        $this->pathname = $value;
        $this->_setField('pathname');
        return $this;
    }

    /**
     * @return ?value-of<FlowActionAuth0SendRequestParamsMethod>
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param ?value-of<FlowActionAuth0SendRequestParamsMethod> $value
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
