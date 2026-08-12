<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetGuardianFactorsProviderSmsResponseContent extends JsonSerializableType
{
    /**
     * @var ?value-of<GuardianFactorsProviderSmsProviderEnum> $provider
     */
    #[JsonProperty('provider')]
    private ?string $provider;

    /**
     * @param array{
     *   provider?: ?value-of<GuardianFactorsProviderSmsProviderEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->provider = $values['provider'] ?? null;
    }

    /**
     * @return ?value-of<GuardianFactorsProviderSmsProviderEnum>
     */
    public function getProvider(): ?string
    {
        return $this->provider;
    }

    /**
     * @param ?value-of<GuardianFactorsProviderSmsProviderEnum> $value
     */
    public function setProvider(?string $value = null): self
    {
        $this->provider = $value;
        $this->_setField('provider');
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
