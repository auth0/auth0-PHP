<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for the 'sms' connection
 */
class ConnectionOptionsSms extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?bool $bruteForceProtection Whether brute force protection is enabled
     */
    #[JsonProperty('brute_force_protection')]
    private ?bool $bruteForceProtection;

    /**
     * @var ?bool $disableSignup
     */
    #[JsonProperty('disable_signup')]
    private ?bool $disableSignup;

    /**
     * @var ?bool $forwardReqInfo
     */
    #[JsonProperty('forward_req_info')]
    private ?bool $forwardReqInfo;

    /**
     * @var ?string $from
     */
    #[JsonProperty('from')]
    private ?string $from;

    /**
     * @var ?ConnectionGatewayAuthenticationSms $gatewayAuthentication
     */
    #[JsonProperty('gateway_authentication')]
    private ?ConnectionGatewayAuthenticationSms $gatewayAuthentication;

    /**
     * @var ?string $gatewayUrl
     */
    #[JsonProperty('gateway_url')]
    private ?string $gatewayUrl;

    /**
     * @var ?string $messagingServiceSid
     */
    #[JsonProperty('messaging_service_sid')]
    private ?string $messagingServiceSid;

    /**
     * @var ?string $name Connection name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?value-of<ConnectionProviderEnumSms> $provider
     */
    #[JsonProperty('provider')]
    private ?string $provider;

    /**
     * @var ?value-of<ConnectionTemplateSyntaxEnumSms> $syntax
     */
    #[JsonProperty('syntax')]
    private ?string $syntax;

    /**
     * @var ?string $template
     */
    #[JsonProperty('template')]
    private ?string $template;

    /**
     * @var ?ConnectionTotpSms $totp
     */
    #[JsonProperty('totp')]
    private ?ConnectionTotpSms $totp;

    /**
     * @var ?string $twilioSid
     */
    #[JsonProperty('twilio_sid')]
    private ?string $twilioSid;

    /**
     * @var ?string $twilioToken
     */
    #[JsonProperty('twilio_token')]
    private ?string $twilioToken;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   bruteForceProtection?: ?bool,
     *   disableSignup?: ?bool,
     *   forwardReqInfo?: ?bool,
     *   from?: ?string,
     *   gatewayAuthentication?: ?ConnectionGatewayAuthenticationSms,
     *   gatewayUrl?: ?string,
     *   messagingServiceSid?: ?string,
     *   name?: ?string,
     *   provider?: ?value-of<ConnectionProviderEnumSms>,
     *   syntax?: ?value-of<ConnectionTemplateSyntaxEnumSms>,
     *   template?: ?string,
     *   totp?: ?ConnectionTotpSms,
     *   twilioSid?: ?string,
     *   twilioToken?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->bruteForceProtection = $values['bruteForceProtection'] ?? null;
        $this->disableSignup = $values['disableSignup'] ?? null;
        $this->forwardReqInfo = $values['forwardReqInfo'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->gatewayAuthentication = $values['gatewayAuthentication'] ?? null;
        $this->gatewayUrl = $values['gatewayUrl'] ?? null;
        $this->messagingServiceSid = $values['messagingServiceSid'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->provider = $values['provider'] ?? null;
        $this->syntax = $values['syntax'] ?? null;
        $this->template = $values['template'] ?? null;
        $this->totp = $values['totp'] ?? null;
        $this->twilioSid = $values['twilioSid'] ?? null;
        $this->twilioToken = $values['twilioToken'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getBruteForceProtection(): ?bool
    {
        return $this->bruteForceProtection;
    }

    /**
     * @param ?bool $value
     */
    public function setBruteForceProtection(?bool $value = null): self
    {
        $this->bruteForceProtection = $value;
        $this->_setField('bruteForceProtection');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableSignup(): ?bool
    {
        return $this->disableSignup;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableSignup(?bool $value = null): self
    {
        $this->disableSignup = $value;
        $this->_setField('disableSignup');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getForwardReqInfo(): ?bool
    {
        return $this->forwardReqInfo;
    }

    /**
     * @param ?bool $value
     */
    public function setForwardReqInfo(?bool $value = null): self
    {
        $this->forwardReqInfo = $value;
        $this->_setField('forwardReqInfo');
        return $this;
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
     * @return ?ConnectionGatewayAuthenticationSms
     */
    public function getGatewayAuthentication(): ?ConnectionGatewayAuthenticationSms
    {
        return $this->gatewayAuthentication;
    }

    /**
     * @param ?ConnectionGatewayAuthenticationSms $value
     */
    public function setGatewayAuthentication(?ConnectionGatewayAuthenticationSms $value = null): self
    {
        $this->gatewayAuthentication = $value;
        $this->_setField('gatewayAuthentication');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getGatewayUrl(): ?string
    {
        return $this->gatewayUrl;
    }

    /**
     * @param ?string $value
     */
    public function setGatewayUrl(?string $value = null): self
    {
        $this->gatewayUrl = $value;
        $this->_setField('gatewayUrl');
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionProviderEnumSms>
     */
    public function getProvider(): ?string
    {
        return $this->provider;
    }

    /**
     * @param ?value-of<ConnectionProviderEnumSms> $value
     */
    public function setProvider(?string $value = null): self
    {
        $this->provider = $value;
        $this->_setField('provider');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionTemplateSyntaxEnumSms>
     */
    public function getSyntax(): ?string
    {
        return $this->syntax;
    }

    /**
     * @param ?value-of<ConnectionTemplateSyntaxEnumSms> $value
     */
    public function setSyntax(?string $value = null): self
    {
        $this->syntax = $value;
        $this->_setField('syntax');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param ?string $value
     */
    public function setTemplate(?string $value = null): self
    {
        $this->template = $value;
        $this->_setField('template');
        return $this;
    }

    /**
     * @return ?ConnectionTotpSms
     */
    public function getTotp(): ?ConnectionTotpSms
    {
        return $this->totp;
    }

    /**
     * @param ?ConnectionTotpSms $value
     */
    public function setTotp(?ConnectionTotpSms $value = null): self
    {
        $this->totp = $value;
        $this->_setField('totp');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTwilioSid(): ?string
    {
        return $this->twilioSid;
    }

    /**
     * @param ?string $value
     */
    public function setTwilioSid(?string $value = null): self
    {
        $this->twilioSid = $value;
        $this->_setField('twilioSid');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTwilioToken(): ?string
    {
        return $this->twilioToken;
    }

    /**
     * @param ?string $value
     */
    public function setTwilioToken(?string $value = null): self
    {
        $this->twilioToken = $value;
        $this->_setField('twilioToken');
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
