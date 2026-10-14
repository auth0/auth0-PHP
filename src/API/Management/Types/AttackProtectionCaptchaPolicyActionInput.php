<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * CAPTCHA configuration override for this policy.
 */
class AttackProtectionCaptchaPolicyActionInput extends JsonSerializableType
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
     * @var ?CaptchaPolicyActionRecaptchaV2Input $recaptchaV2
     */
    #[JsonProperty('recaptcha_v2')]
    private ?CaptchaPolicyActionRecaptchaV2Input $recaptchaV2;

    /**
     * @var ?CaptchaPolicyActionRecaptchaEnterpriseInput $recaptchaEnterprise
     */
    #[JsonProperty('recaptcha_enterprise')]
    private ?CaptchaPolicyActionRecaptchaEnterpriseInput $recaptchaEnterprise;

    /**
     * @var ?CaptchaPolicyActionHcaptchaInput $hcaptcha
     */
    #[JsonProperty('hcaptcha')]
    private ?CaptchaPolicyActionHcaptchaInput $hcaptcha;

    /**
     * @var ?CaptchaPolicyActionFriendlyCaptchaInput $friendlyCaptcha
     */
    #[JsonProperty('friendly_captcha')]
    private ?CaptchaPolicyActionFriendlyCaptchaInput $friendlyCaptcha;

    /**
     * @var ?CaptchaPolicyActionArkoseInput $arkose
     */
    #[JsonProperty('arkose')]
    private ?CaptchaPolicyActionArkoseInput $arkose;

    /**
     * @param array{
     *   activeProviderId?: ?value-of<CaptchaActiveProviderEnum>,
     *   simpleCaptcha?: ?CaptchaPolicyActionSimpleCaptcha,
     *   authChallenge?: ?CaptchaPolicyActionAuthChallenge,
     *   recaptchaV2?: ?CaptchaPolicyActionRecaptchaV2Input,
     *   recaptchaEnterprise?: ?CaptchaPolicyActionRecaptchaEnterpriseInput,
     *   hcaptcha?: ?CaptchaPolicyActionHcaptchaInput,
     *   friendlyCaptcha?: ?CaptchaPolicyActionFriendlyCaptchaInput,
     *   arkose?: ?CaptchaPolicyActionArkoseInput,
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
     * @return ?CaptchaPolicyActionRecaptchaV2Input
     */
    public function getRecaptchaV2(): ?CaptchaPolicyActionRecaptchaV2Input
    {
        return $this->recaptchaV2;
    }

    /**
     * @param ?CaptchaPolicyActionRecaptchaV2Input $value
     */
    public function setRecaptchaV2(?CaptchaPolicyActionRecaptchaV2Input $value = null): self
    {
        $this->recaptchaV2 = $value;
        $this->_setField('recaptchaV2');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionRecaptchaEnterpriseInput
     */
    public function getRecaptchaEnterprise(): ?CaptchaPolicyActionRecaptchaEnterpriseInput
    {
        return $this->recaptchaEnterprise;
    }

    /**
     * @param ?CaptchaPolicyActionRecaptchaEnterpriseInput $value
     */
    public function setRecaptchaEnterprise(?CaptchaPolicyActionRecaptchaEnterpriseInput $value = null): self
    {
        $this->recaptchaEnterprise = $value;
        $this->_setField('recaptchaEnterprise');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionHcaptchaInput
     */
    public function getHcaptcha(): ?CaptchaPolicyActionHcaptchaInput
    {
        return $this->hcaptcha;
    }

    /**
     * @param ?CaptchaPolicyActionHcaptchaInput $value
     */
    public function setHcaptcha(?CaptchaPolicyActionHcaptchaInput $value = null): self
    {
        $this->hcaptcha = $value;
        $this->_setField('hcaptcha');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionFriendlyCaptchaInput
     */
    public function getFriendlyCaptcha(): ?CaptchaPolicyActionFriendlyCaptchaInput
    {
        return $this->friendlyCaptcha;
    }

    /**
     * @param ?CaptchaPolicyActionFriendlyCaptchaInput $value
     */
    public function setFriendlyCaptcha(?CaptchaPolicyActionFriendlyCaptchaInput $value = null): self
    {
        $this->friendlyCaptcha = $value;
        $this->_setField('friendlyCaptcha');
        return $this;
    }

    /**
     * @return ?CaptchaPolicyActionArkoseInput
     */
    public function getArkose(): ?CaptchaPolicyActionArkoseInput
    {
        return $this->arkose;
    }

    /**
     * @param ?CaptchaPolicyActionArkoseInput $value
     */
    public function setArkose(?CaptchaPolicyActionArkoseInput $value = null): self
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
