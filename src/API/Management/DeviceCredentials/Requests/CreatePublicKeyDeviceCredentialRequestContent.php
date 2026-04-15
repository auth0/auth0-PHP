<?php

namespace Auth0\SDK\API\Management\DeviceCredentials\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\DeviceCredentialPublicKeyTypeEnum;

class CreatePublicKeyDeviceCredentialRequestContent extends JsonSerializableType
{
    /**
     * @var string $deviceName Name for this device easily recognized by owner.
     */
    #[JsonProperty('device_name')]
    private string $deviceName;

    /**
     * @var value-of<DeviceCredentialPublicKeyTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $value Base64 encoded string containing the credential.
     */
    #[JsonProperty('value')]
    private string $value;

    /**
     * @var string $deviceId Unique identifier for the device. Recommend using <a href="http://developer.android.com/reference/android/provider/Settings.Secure.html#ANDROID_ID">Android_ID</a> on Android and <a href="https://developer.apple.com/library/ios/documentation/UIKit/Reference/UIDevice_Class/index.html#//apple_ref/occ/instp/UIDevice/identifierForVendor">identifierForVendor</a>.
     */
    #[JsonProperty('device_id')]
    private string $deviceId;

    /**
     * @var ?string $clientId client_id of the client (application) this credential is for.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @param array{
     *   deviceName: string,
     *   type: value-of<DeviceCredentialPublicKeyTypeEnum>,
     *   value: string,
     *   deviceId: string,
     *   clientId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->deviceName = $values['deviceName'];
        $this->type = $values['type'];
        $this->value = $values['value'];
        $this->deviceId = $values['deviceId'];
        $this->clientId = $values['clientId'] ?? null;
    }

    /**
     * @return string
     */
    public function getDeviceName(): string
    {
        return $this->deviceName;
    }

    /**
     * @param string $value
     */
    public function setDeviceName(string $value): self
    {
        $this->deviceName = $value;
        $this->_setField('deviceName');
        return $this;
    }

    /**
     * @return value-of<DeviceCredentialPublicKeyTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<DeviceCredentialPublicKeyTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        $this->_setField('value');
        return $this;
    }

    /**
     * @return string
     */
    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    /**
     * @param string $value
     */
    public function setDeviceId(string $value): self
    {
        $this->deviceId = $value;
        $this->_setField('deviceId');
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
}
