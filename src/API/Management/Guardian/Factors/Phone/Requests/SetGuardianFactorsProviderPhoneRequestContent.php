<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Phone\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\GuardianFactorsProviderSmsProviderEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetGuardianFactorsProviderPhoneRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<GuardianFactorsProviderSmsProviderEnum> $provider
     */
    #[JsonProperty('provider')]
    private string $provider;

    /**
     * @param array{
     *   provider: value-of<GuardianFactorsProviderSmsProviderEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->provider = $values['provider'];
    }

    /**
     * @return value-of<GuardianFactorsProviderSmsProviderEnum>
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param value-of<GuardianFactorsProviderSmsProviderEnum> $value
     */
    public function setProvider(string $value): self
    {
        $this->provider = $value;
        $this->_setField('provider');
        return $this;
    }
}
