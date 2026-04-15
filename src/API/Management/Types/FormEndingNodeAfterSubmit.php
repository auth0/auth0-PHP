<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormEndingNodeAfterSubmit extends JsonSerializableType
{
    /**
     * @var ?string $flowId
     */
    #[JsonProperty('flow_id')]
    private ?string $flowId;

    /**
     * @param array{
     *   flowId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->flowId = $values['flowId'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFlowId(): ?string
    {
        return $this->flowId;
    }

    /**
     * @param ?string $value
     */
    public function setFlowId(?string $value = null): self
    {
        $this->flowId = $value;
        $this->_setField('flowId');
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
