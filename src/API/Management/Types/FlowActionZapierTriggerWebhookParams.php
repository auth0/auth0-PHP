<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionZapierTriggerWebhookParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var ?value-of<FlowActionZapierTriggerWebhookParamsMethod> $method
     */
    #[JsonProperty('method')]
    private ?string $method;

    /**
     * @param array{
     *   connectionId: string,
     *   method?: ?value-of<FlowActionZapierTriggerWebhookParamsMethod>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->method = $values['method'] ?? null;
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
     * @return ?value-of<FlowActionZapierTriggerWebhookParamsMethod>
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param ?value-of<FlowActionZapierTriggerWebhookParamsMethod> $value
     */
    public function setMethod(?string $value = null): self
    {
        $this->method = $value;
        $this->_setField('method');
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
