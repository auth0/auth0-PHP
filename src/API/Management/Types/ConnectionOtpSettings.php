<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * One-time password settings, configurable per delivery channel.
 */
class ConnectionOtpSettings extends JsonSerializableType
{
    /**
     * @var ?ConnectionOtpChannelSettings $email
     */
    #[JsonProperty('email')]
    private ?ConnectionOtpChannelSettings $email;

    /**
     * @var ?ConnectionOtpChannelSettings $phone
     */
    #[JsonProperty('phone')]
    private ?ConnectionOtpChannelSettings $phone;

    /**
     * @param array{
     *   email?: ?ConnectionOtpChannelSettings,
     *   phone?: ?ConnectionOtpChannelSettings,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->email = $values['email'] ?? null;
        $this->phone = $values['phone'] ?? null;
    }

    /**
     * @return ?ConnectionOtpChannelSettings
     */
    public function getEmail(): ?ConnectionOtpChannelSettings
    {
        return $this->email;
    }

    /**
     * @param ?ConnectionOtpChannelSettings $value
     */
    public function setEmail(?ConnectionOtpChannelSettings $value = null): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?ConnectionOtpChannelSettings
     */
    public function getPhone(): ?ConnectionOtpChannelSettings
    {
        return $this->phone;
    }

    /**
     * @param ?ConnectionOtpChannelSettings $value
     */
    public function setPhone(?ConnectionOtpChannelSettings $value = null): self
    {
        $this->phone = $value;
        $this->_setField('phone');
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
