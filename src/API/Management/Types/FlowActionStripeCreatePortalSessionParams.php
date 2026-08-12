<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionStripeCreatePortalSessionParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $customerId
     */
    #[JsonProperty('customer_id')]
    private string $customerId;

    /**
     * @var ?string $returnUrl
     */
    #[JsonProperty('return_url')]
    private ?string $returnUrl;

    /**
     * @param array{
     *   connectionId: string,
     *   customerId: string,
     *   returnUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->customerId = $values['customerId'];
        $this->returnUrl = $values['returnUrl'] ?? null;
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
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * @param string $value
     */
    public function setCustomerId(string $value): self
    {
        $this->customerId = $value;
        $this->_setField('customerId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getReturnUrl(): ?string
    {
        return $this->returnUrl;
    }

    /**
     * @param ?string $value
     */
    public function setReturnUrl(?string $value = null): self
    {
        $this->returnUrl = $value;
        $this->_setField('returnUrl');
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
