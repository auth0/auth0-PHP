<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateGuardianFactorsProviderPushNotificationFcmRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $serverKey
     */
    #[JsonProperty('server_key')]
    private ?string $serverKey;

    /**
     * @param array{
     *   serverKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->serverKey = $values['serverKey'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getServerKey(): ?string
    {
        return $this->serverKey;
    }

    /**
     * @param ?string $value
     */
    public function setServerKey(?string $value = null): self
    {
        $this->serverKey = $value;
        $this->_setField('serverKey');
        return $this;
    }
}
