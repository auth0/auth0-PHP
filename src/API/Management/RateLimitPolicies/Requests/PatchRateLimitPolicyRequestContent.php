<?php

namespace Auth0\SDK\API\Management\RateLimitPolicies\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\PatchRateLimitPolicyConfigurationRequestContentZero;
use Auth0\SDK\API\Management\Types\PatchRateLimitPolicyConfigurationRequestContentOne;
use Auth0\SDK\API\Management\Types\PatchRateLimitPolicyConfigurationRequestContentAction;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class PatchRateLimitPolicyRequestContent extends JsonSerializableType
{
    /**
     * @var (
     *    PatchRateLimitPolicyConfigurationRequestContentZero
     *   |PatchRateLimitPolicyConfigurationRequestContentOne
     *   |PatchRateLimitPolicyConfigurationRequestContentAction
     * ) $configuration
     */
    #[JsonProperty('configuration'), Union(PatchRateLimitPolicyConfigurationRequestContentZero::class, PatchRateLimitPolicyConfigurationRequestContentOne::class, PatchRateLimitPolicyConfigurationRequestContentAction::class)]
    private PatchRateLimitPolicyConfigurationRequestContentZero|PatchRateLimitPolicyConfigurationRequestContentOne|PatchRateLimitPolicyConfigurationRequestContentAction $configuration;

    /**
     * @param array{
     *   configuration: (
     *    PatchRateLimitPolicyConfigurationRequestContentZero
     *   |PatchRateLimitPolicyConfigurationRequestContentOne
     *   |PatchRateLimitPolicyConfigurationRequestContentAction
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->configuration = $values['configuration'];
    }

    /**
     * @return (
     *    PatchRateLimitPolicyConfigurationRequestContentZero
     *   |PatchRateLimitPolicyConfigurationRequestContentOne
     *   |PatchRateLimitPolicyConfigurationRequestContentAction
     * )
     */
    public function getConfiguration(): PatchRateLimitPolicyConfigurationRequestContentZero|PatchRateLimitPolicyConfigurationRequestContentOne|PatchRateLimitPolicyConfigurationRequestContentAction
    {
        return $this->configuration;
    }

    /**
     * @param (
     *    PatchRateLimitPolicyConfigurationRequestContentZero
     *   |PatchRateLimitPolicyConfigurationRequestContentOne
     *   |PatchRateLimitPolicyConfigurationRequestContentAction
     * ) $value
     */
    public function setConfiguration(PatchRateLimitPolicyConfigurationRequestContentZero|PatchRateLimitPolicyConfigurationRequestContentOne|PatchRateLimitPolicyConfigurationRequestContentAction $value): self
    {
        $this->configuration = $value;
        $this->_setField('configuration');
        return $this;
    }
}
