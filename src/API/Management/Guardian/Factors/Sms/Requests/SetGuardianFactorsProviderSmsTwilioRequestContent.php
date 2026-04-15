<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Sms\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetGuardianFactorsProviderSmsTwilioRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $from From number
     */
    #[JsonProperty('from')]
    private ?string $from;

    /**
     * @var ?string $messagingServiceSid Copilot SID
     */
    #[JsonProperty('messaging_service_sid')]
    private ?string $messagingServiceSid;

    /**
     * @var ?string $authToken Twilio Authentication token
     */
    #[JsonProperty('auth_token')]
    private ?string $authToken;

    /**
     * @var ?string $sid Twilio SID
     */
    #[JsonProperty('sid')]
    private ?string $sid;

    /**
     * @param array{
     *   from?: ?string,
     *   messagingServiceSid?: ?string,
     *   authToken?: ?string,
     *   sid?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->from = $values['from'] ?? null;
        $this->messagingServiceSid = $values['messagingServiceSid'] ?? null;
        $this->authToken = $values['authToken'] ?? null;
        $this->sid = $values['sid'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMessagingServiceSid(): ?string
    {
        return $this->messagingServiceSid;
    }

    /**
     * @param ?string $value
     */
    public function setMessagingServiceSid(?string $value = null): self
    {
        $this->messagingServiceSid = $value;
        $this->_setField('messagingServiceSid');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    /**
     * @param ?string $value
     */
    public function setAuthToken(?string $value = null): self
    {
        $this->authToken = $value;
        $this->_setField('authToken');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSid(): ?string
    {
        return $this->sid;
    }

    /**
     * @param ?string $value
     */
    public function setSid(?string $value = null): self
    {
        $this->sid = $value;
        $this->_setField('sid');
        return $this;
    }
}
