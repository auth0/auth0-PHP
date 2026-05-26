<?php

namespace Auth0\SDK\API\Management\RateLimitPolicies\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\RateLimitPolicyResourceEnum;
use Auth0\SDK\API\Management\Types\RateLimitPolicyConsumerEnum;

class ListRateLimitPoliciesRequestParameters extends JsonSerializableType
{
    /**
     * @var ?value-of<RateLimitPolicyResourceEnum> $resource The API protected by the Rate Limit Policy.
     */
    private ?string $resource;

    /**
     * @var ?value-of<RateLimitPolicyConsumerEnum> $consumer The consumer to which the rate limit policy applies.
     */
    private ?string $consumer;

    /**
     * @var ?string $consumerSelector Identifier or category within the consumer to which the policy applies. Supported values: `client_id:<client_id>` to target a specific client by ID, `client_id:<cimd_uri>` to target a CIMD client by URI, `cimd_clients` to target all CIMD clients, `third_party_clients` to target all third-party clients, or `default` to apply the policy to any consumer identifier not otherwise explicitly targeted.
     */
    private ?string $consumerSelector;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @var ?string $from Cursor for pagination.
     */
    private ?string $from;

    /**
     * @param array{
     *   resource?: ?value-of<RateLimitPolicyResourceEnum>,
     *   consumer?: ?value-of<RateLimitPolicyConsumerEnum>,
     *   consumerSelector?: ?string,
     *   take?: ?int,
     *   from?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->resource = $values['resource'] ?? null;
        $this->consumer = $values['consumer'] ?? null;
        $this->consumerSelector = $values['consumerSelector'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->from = $values['from'] ?? null;
    }

    /**
     * @return ?value-of<RateLimitPolicyResourceEnum>
     */
    public function getResource(): ?string
    {
        return $this->resource;
    }

    /**
     * @param ?value-of<RateLimitPolicyResourceEnum> $value
     */
    public function setResource(?string $value = null): self
    {
        $this->resource = $value;
        $this->_setField('resource');
        return $this;
    }

    /**
     * @return ?value-of<RateLimitPolicyConsumerEnum>
     */
    public function getConsumer(): ?string
    {
        return $this->consumer;
    }

    /**
     * @param ?value-of<RateLimitPolicyConsumerEnum> $value
     */
    public function setConsumer(?string $value = null): self
    {
        $this->consumer = $value;
        $this->_setField('consumer');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getConsumerSelector(): ?string
    {
        return $this->consumerSelector;
    }

    /**
     * @param ?string $value
     */
    public function setConsumerSelector(?string $value = null): self
    {
        $this->consumerSelector = $value;
        $this->_setField('consumerSelector');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTake(): ?int
    {
        return $this->take;
    }

    /**
     * @param ?int $value
     */
    public function setTake(?int $value = null): self
    {
        $this->take = $value;
        $this->_setField('take');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }
}
