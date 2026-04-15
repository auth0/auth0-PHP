<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\GuardianFactorsProviderPushNotificationProviderDataEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetGuardianFactorsProviderPushNotificationRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<GuardianFactorsProviderPushNotificationProviderDataEnum> $provider
     */
    #[JsonProperty('provider')]
    private string $provider;

    /**
     * @param array{
     *   provider: value-of<GuardianFactorsProviderPushNotificationProviderDataEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->provider = $values['provider'];
    }

    /**
     * @return value-of<GuardianFactorsProviderPushNotificationProviderDataEnum>
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param value-of<GuardianFactorsProviderPushNotificationProviderDataEnum> $value
     */
    public function setProvider(string $value): self
    {
        $this->provider = $value;
        $this->_setField('provider');
        return $this;
    }
}
