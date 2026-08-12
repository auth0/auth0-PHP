<?php

namespace Auth0\SDK\API\Management\RateLimitPolicies\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\RateLimitPolicyResourceEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\RateLimitPolicyConsumerEnum;
use Auth0\SDK\API\Management\Types\RateLimitPolicyConfigurationZero;
use Auth0\SDK\API\Management\Types\RateLimitPolicyConfigurationOne;
use Auth0\SDK\API\Management\Types\RateLimitPolicyConfigurationAction;
use Auth0\SDK\API\Management\Core\Types\Union;

class CreateRateLimitPolicyRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<RateLimitPolicyResourceEnum> $resource
     */
    #[JsonProperty('resource')]
    private string $resource;

    /**
     * @var value-of<RateLimitPolicyConsumerEnum> $consumer
     */
    #[JsonProperty('consumer')]
    private string $consumer;

    /**
     * @var string $consumerSelector Identifier or category within the consumer to which the policy applies. Supported values: `client_id:<client_id>` to target a specific client by ID, `client_id:<cimd_uri>` to target a CIMD client by URI, `cimd_clients` to target all CIMD clients, `third_party_clients` to target all third-party clients, or `default` to apply the policy to any consumer identifier not otherwise explicitly targeted.
     */
    #[JsonProperty('consumer_selector')]
    private string $consumerSelector;

    /**
     * @var (
     *    RateLimitPolicyConfigurationZero
     *   |RateLimitPolicyConfigurationOne
     *   |RateLimitPolicyConfigurationAction
     * ) $configuration
     */
    #[JsonProperty('configuration'), Union(RateLimitPolicyConfigurationZero::class, RateLimitPolicyConfigurationOne::class, RateLimitPolicyConfigurationAction::class)]
    private RateLimitPolicyConfigurationZero|RateLimitPolicyConfigurationOne|RateLimitPolicyConfigurationAction $configuration;

    /**
     * @param array{
     *   resource: value-of<RateLimitPolicyResourceEnum>,
     *   consumer: value-of<RateLimitPolicyConsumerEnum>,
     *   consumerSelector: string,
     *   configuration: (
     *    RateLimitPolicyConfigurationZero
     *   |RateLimitPolicyConfigurationOne
     *   |RateLimitPolicyConfigurationAction
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->resource = $values['resource'];
        $this->consumer = $values['consumer'];
        $this->consumerSelector = $values['consumerSelector'];
        $this->configuration = $values['configuration'];
    }

    /**
     * @return value-of<RateLimitPolicyResourceEnum>
     */
    public function getResource(): string
    {
        return $this->resource;
    }

    /**
     * @param value-of<RateLimitPolicyResourceEnum> $value
     */
    public function setResource(string $value): self
    {
        $this->resource = $value;
        $this->_setField('resource');
        return $this;
    }

    /**
     * @return value-of<RateLimitPolicyConsumerEnum>
     */
    public function getConsumer(): string
    {
        return $this->consumer;
    }

    /**
     * @param value-of<RateLimitPolicyConsumerEnum> $value
     */
    public function setConsumer(string $value): self
    {
        $this->consumer = $value;
        $this->_setField('consumer');
        return $this;
    }

    /**
     * @return string
     */
    public function getConsumerSelector(): string
    {
        return $this->consumerSelector;
    }

    /**
     * @param string $value
     */
    public function setConsumerSelector(string $value): self
    {
        $this->consumerSelector = $value;
        $this->_setField('consumerSelector');
        return $this;
    }

    /**
     * @return (
     *    RateLimitPolicyConfigurationZero
     *   |RateLimitPolicyConfigurationOne
     *   |RateLimitPolicyConfigurationAction
     * )
     */
    public function getConfiguration(): RateLimitPolicyConfigurationZero|RateLimitPolicyConfigurationOne|RateLimitPolicyConfigurationAction
    {
        return $this->configuration;
    }

    /**
     * @param (
     *    RateLimitPolicyConfigurationZero
     *   |RateLimitPolicyConfigurationOne
     *   |RateLimitPolicyConfigurationAction
     * ) $value
     */
    public function setConfiguration(RateLimitPolicyConfigurationZero|RateLimitPolicyConfigurationOne|RateLimitPolicyConfigurationAction $value): self
    {
        $this->configuration = $value;
        $this->_setField('configuration');
        return $this;
    }
}
