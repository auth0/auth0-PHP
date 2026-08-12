<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class DeviceCredential extends JsonSerializableType
{
    /**
     * @var ?string $id ID of this device.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $deviceName User agent for this device
     */
    #[JsonProperty('device_name')]
    private ?string $deviceName;

    /**
     * @var ?string $deviceId Unique identifier for the device. NOTE: This field is generally not populated for refresh_tokens and rotating_refresh_tokens
     */
    #[JsonProperty('device_id')]
    private ?string $deviceId;

    /**
     * @var ?value-of<DeviceCredentialTypeEnum> $type Type of credential. Can be `public_key`, `refresh_token`, or `rotating_refresh_token`.
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $userId user_id this credential is associated with.
     */
    #[JsonProperty('user_id')]
    private ?string $userId;

    /**
     * @var ?string $clientId client_id of the client (application) this credential is for.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @param array{
     *   id?: ?string,
     *   deviceName?: ?string,
     *   deviceId?: ?string,
     *   type?: ?value-of<DeviceCredentialTypeEnum>,
     *   userId?: ?string,
     *   clientId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->deviceName = $values['deviceName'] ?? null;
        $this->deviceId = $values['deviceId'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDeviceName(): ?string
    {
        return $this->deviceName;
    }

    /**
     * @param ?string $value
     */
    public function setDeviceName(?string $value = null): self
    {
        $this->deviceName = $value;
        $this->_setField('deviceName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    /**
     * @param ?string $value
     */
    public function setDeviceId(?string $value = null): self
    {
        $this->deviceId = $value;
        $this->_setField('deviceId');
        return $this;
    }

    /**
     * @return ?value-of<DeviceCredentialTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<DeviceCredentialTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param ?string $value
     */
    public function setUserId(?string $value = null): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
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
