<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class ConsentSigningKey extends JsonSerializableType
{
    /**
     * @var string $kid The key identifier of the consent signing key.
     */
    #[JsonProperty('kid')]
    private string $kid;

    /**
     * @var string $deviceIdentifier A human-readable label for the device holding the corresponding private key.
     */
    #[JsonProperty('device_identifier')]
    private string $deviceIdentifier;

    /**
     * @var DateTime $createdAt The ISO 8601 timestamp at which the key was registered.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $expiresAt The ISO 8601 timestamp at which the key expires and can no longer be used to verify consent decisions.
     */
    #[JsonProperty('expires_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $expiresAt;

    /**
     * @param array{
     *   kid: string,
     *   deviceIdentifier: string,
     *   createdAt: DateTime,
     *   expiresAt: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->kid = $values['kid'];
        $this->deviceIdentifier = $values['deviceIdentifier'];
        $this->createdAt = $values['createdAt'];
        $this->expiresAt = $values['expiresAt'];
    }

    /**
     * @return string
     */
    public function getKid(): string
    {
        return $this->kid;
    }

    /**
     * @param string $value
     */
    public function setKid(string $value): self
    {
        $this->kid = $value;
        $this->_setField('kid');
        return $this;
    }

    /**
     * @return string
     */
    public function getDeviceIdentifier(): string
    {
        return $this->deviceIdentifier;
    }

    /**
     * @param string $value
     */
    public function setDeviceIdentifier(string $value): self
    {
        $this->deviceIdentifier = $value;
        $this->_setField('deviceIdentifier');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpiresAt(): DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param DateTime $value
     */
    public function setExpiresAt(DateTime $value): self
    {
        $this->expiresAt = $value;
        $this->_setField('expiresAt');
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
