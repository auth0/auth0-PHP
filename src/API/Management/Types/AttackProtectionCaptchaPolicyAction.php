<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * CAPTCHA configuration override stored for this policy.
 */
class AttackProtectionCaptchaPolicyAction extends JsonSerializableType
{
    /**
     * @var ?value-of<CaptchaActiveProviderEnum> $activeProviderId
     */
    #[JsonProperty('active_provider_id')]
    private ?string $activeProviderId;

    /**
     * @var ?CaptchaPolicyActionSimpleCaptcha $simpleCaptcha
     */
    #[JsonProperty('simple_captcha')]
    private ?CaptchaPolicyActionSimpleCaptcha $simpleCaptcha;

    /**
     * @var ?CaptchaPolicyActionAuthChallenge $authChallenge
     */
    #[JsonProperty('auth_challenge')]
    private ?CaptchaPolicyActionAuthChallenge $authChallenge;

    /**
     * @var ?CaptchaPolicyActionRecaptchaV2 $recaptchaV2
     */
    #[JsonProperty('recaptcha_v2')]
    private ?CaptchaPolicyActionRecaptchaV2 $recaptchaV2;

    /**
     * @var ?CaptchaPolicyActionRecaptchaEnterprise $recaptchaEnterprise
     */
    #[JsonProperty('recaptcha_enterprise')]
    private ?CaptchaPolicyActionRecaptchaEnterprise $recaptchaEnterprise;

    /**
     * @var ?CaptchaPolicyActionHcaptcha $hcaptcha
     */
    #[JsonProperty('hcaptcha')]
    private ?CaptchaPolicyActionHcaptcha $hcaptcha;

    /**
     * @var ?CaptchaPolicyActionFriendlyCaptcha $friendlyCaptcha
     */
    #[JsonProperty('friendly_captcha')]
    private ?CaptchaPolicyActionFriendlyCaptcha $friendlyCaptcha;

    /**
     * @var ?CaptchaPolicyActionArkose $arkose
     */
    #[JsonProperty('arkose')]
    private ?CaptchaPolicyActionArkose $arkose;

    /**
     * @param array{
     *   activeProviderId?: ?value-of<CaptchaActiveProviderEnum>,
     *   simpleCaptcha?: ?CaptchaPolicyActionSimpleCaptcha,
     *   authChallenge?: ?CaptchaPolicyActionAuthChallenge,
     *   recaptchaV2?: ?CaptchaPolicyActionRecaptchaV2,
     *   recaptchaEnterprise?: ?CaptchaPolicyActionRecaptchaEnterprise,
     *   hcaptcha?: ?CaptchaPolicyActionHcaptcha,
     *   friendlyCaptcha?: ?CaptchaPolicyActionFriendlyCaptcha,
     *   arkose?: ?CaptchaPolicyActionArkose,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->activeProviderId = $values['activeProviderId'] ?? null;
        $this->simpleCaptcha = $values['simpleCaptcha'] ?? null;
        $this->authChallenge = $values['authChallenge'] ?? null;
        $this->recaptchaV2 = $values['recaptchaV2'] ?? null;
        $this->recaptchaEnterprise = $values['recaptchaEnterprise'] ?? null;
        $this->hcaptcha = $values['hcaptcha'] ?? null;
        $this->friendlyCaptcha = $values['friendlyCaptcha'] ?? null;
        $this->arkose = $values['arkose'] ?? null;
    }

    /**
     * @return ?value-of<CaptchaActiveProviderEnum>
     */
    public function getActiveProviderId(): ?string
    {
        return $this->activeProviderId;
    }

    /**
     * @param ?value-of<CaptchaActiveProviderEnum> $value
     */
    public function setActiveProviderId(?string $value = null): self
    {
        $this->activeProviderId = $value;
        $this->_setField('activeProviderId');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionSimpleCaptcha
     */
    public function getSimpleCaptcha(): ?CaptchaPolicyActionSimpleCaptcha
    {
        return $this->simpleCaptcha;
    }

    /**
     * @param ?CaptchaPolicyActionSimpleCaptcha $value
     */
    public function setSimpleCaptcha(?CaptchaPolicyActionSimpleCaptcha $value = null): self
    {
        $this->simpleCaptcha = $value;
        $this->_setField('simpleCaptcha');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionAuthChallenge
     */
    public function getAuthChallenge(): ?CaptchaPolicyActionAuthChallenge
    {
        return $this->authChallenge;
    }

    /**
     * @param ?CaptchaPolicyActionAuthChallenge $value
     */
    public function setAuthChallenge(?CaptchaPolicyActionAuthChallenge $value = null): self
    {
        $this->authChallenge = $value;
        $this->_setField('authChallenge');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionRecaptchaV2
     */
    public function getRecaptchaV2(): ?CaptchaPolicyActionRecaptchaV2
    {
        return $this->recaptchaV2;
    }

    /**
     * @param ?CaptchaPolicyActionRecaptchaV2 $value
     */
    public function setRecaptchaV2(?CaptchaPolicyActionRecaptchaV2 $value = null): self
    {
        $this->recaptchaV2 = $value;
        $this->_setField('recaptchaV2');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionRecaptchaEnterprise
     */
    public function getRecaptchaEnterprise(): ?CaptchaPolicyActionRecaptchaEnterprise
    {
        return $this->recaptchaEnterprise;
    }

    /**
     * @param ?CaptchaPolicyActionRecaptchaEnterprise $value
     */
    public function setRecaptchaEnterprise(?CaptchaPolicyActionRecaptchaEnterprise $value = null): self
    {
        $this->recaptchaEnterprise = $value;
        $this->_setField('recaptchaEnterprise');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionHcaptcha
     */
    public function getHcaptcha(): ?CaptchaPolicyActionHcaptcha
    {
        return $this->hcaptcha;
    }

    /**
     * @param ?CaptchaPolicyActionHcaptcha $value
     */
    public function setHcaptcha(?CaptchaPolicyActionHcaptcha $value = null): self
    {
        $this->hcaptcha = $value;
        $this->_setField('hcaptcha');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionFriendlyCaptcha
     */
    public function getFriendlyCaptcha(): ?CaptchaPolicyActionFriendlyCaptcha
    {
        return $this->friendlyCaptcha;
    }

    /**
     * @param ?CaptchaPolicyActionFriendlyCaptcha $value
     */
    public function setFriendlyCaptcha(?CaptchaPolicyActionFriendlyCaptcha $value = null): self
    {
        $this->friendlyCaptcha = $value;
        $this->_setField('friendlyCaptcha');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionArkose
     */
    public function getArkose(): ?CaptchaPolicyActionArkose
    {
        return $this->arkose;
    }

    /**
     * @param ?CaptchaPolicyActionArkose $value
     */
    public function setArkose(?CaptchaPolicyActionArkose $value = null): self
    {
        $this->arkose = $value;
        $this->_setField('arkose');
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
