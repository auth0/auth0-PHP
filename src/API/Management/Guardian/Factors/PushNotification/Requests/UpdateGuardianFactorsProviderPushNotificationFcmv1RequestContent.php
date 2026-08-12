<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateGuardianFactorsProviderPushNotificationFcmv1RequestContent extends JsonSerializableType
{
    /**
     * @var ?string $serverCredentials
     */
    #[JsonProperty('server_credentials')]
    private ?string $serverCredentials;

    /**
     * @param array{
     *   serverCredentials?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->serverCredentials = $values['serverCredentials'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getServerCredentials(): ?string
    {
        return $this->serverCredentials;
    }

    /**
     * @param ?string $value
     */
    public function setServerCredentials(?string $value = null): self
    {
        $this->serverCredentials = $value;
        $this->_setField('serverCredentials');
        return $this;
    }
}
