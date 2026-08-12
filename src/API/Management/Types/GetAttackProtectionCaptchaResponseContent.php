<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetAttackProtectionCaptchaResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $activeProviderId
     */
    #[JsonProperty('active_provider_id')]
    private ?string $activeProviderId;

    /**
     * @var ?AttackProtectionCaptchaArkoseResponseContent $arkose
     */
    #[JsonProperty('arkose')]
    private ?AttackProtectionCaptchaArkoseResponseContent $arkose;

    /**
     * @var ?AttackProtectionCaptchaAuthChallengeResponseContent $authChallenge
     */
    #[JsonProperty('auth_challenge')]
    private ?AttackProtectionCaptchaAuthChallengeResponseContent $authChallenge;

    /**
     * @var ?AttackProtectionCaptchaHcaptchaResponseContent $hcaptcha
     */
    #[JsonProperty('hcaptcha')]
    private ?AttackProtectionCaptchaHcaptchaResponseContent $hcaptcha;

    /**
     * @var ?AttackProtectionCaptchaFriendlyCaptchaResponseContent $friendlyCaptcha
     */
    #[JsonProperty('friendly_captcha')]
    private ?AttackProtectionCaptchaFriendlyCaptchaResponseContent $friendlyCaptcha;

    /**
     * @var ?AttackProtectionCaptchaRecaptchaEnterpriseResponseContent $recaptchaEnterprise
     */
    #[JsonProperty('recaptcha_enterprise')]
    private ?AttackProtectionCaptchaRecaptchaEnterpriseResponseContent $recaptchaEnterprise;

    /**
     * @var ?AttackProtectionCaptchaRecaptchaV2ResponseContent $recaptchaV2
     */
    #[JsonProperty('recaptcha_v2')]
    private ?AttackProtectionCaptchaRecaptchaV2ResponseContent $recaptchaV2;

    /**
     * @var ?array<string, mixed> $simpleCaptcha
     */
    #[JsonProperty('simple_captcha'), ArrayType(['string' => 'mixed'])]
    private ?array $simpleCaptcha;

    /**
     * @param array{
     *   activeProviderId?: ?string,
     *   arkose?: ?AttackProtectionCaptchaArkoseResponseContent,
     *   authChallenge?: ?AttackProtectionCaptchaAuthChallengeResponseContent,
     *   hcaptcha?: ?AttackProtectionCaptchaHcaptchaResponseContent,
     *   friendlyCaptcha?: ?AttackProtectionCaptchaFriendlyCaptchaResponseContent,
     *   recaptchaEnterprise?: ?AttackProtectionCaptchaRecaptchaEnterpriseResponseContent,
     *   recaptchaV2?: ?AttackProtectionCaptchaRecaptchaV2ResponseContent,
     *   simpleCaptcha?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->activeProviderId = $values['activeProviderId'] ?? null;
        $this->arkose = $values['arkose'] ?? null;
        $this->authChallenge = $values['authChallenge'] ?? null;
        $this->hcaptcha = $values['hcaptcha'] ?? null;
        $this->friendlyCaptcha = $values['friendlyCaptcha'] ?? null;
        $this->recaptchaEnterprise = $values['recaptchaEnterprise'] ?? null;
        $this->recaptchaV2 = $values['recaptchaV2'] ?? null;
        $this->simpleCaptcha = $values['simpleCaptcha'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getActiveProviderId(): ?string
    {
        return $this->activeProviderId;
    }

    /**
     * @param ?string $value
     */
    public function setActiveProviderId(?string $value = null): self
    {
        $this->activeProviderId = $value;
        $this->_setField('activeProviderId');
        return $this;
    }

    /**
     * @return ?AttackProtectionCaptchaArkoseResponseContent
     */
    public function getArkose(): ?AttackProtectionCaptchaArkoseResponseContent
    {
        return $this->arkose;
    }

    /**
     * @param ?AttackProtectionCaptchaArkoseResponseContent $value
     */
    public function setArkose(?AttackProtectionCaptchaArkoseResponseContent $value = null): self
    {
        $this->arkose = $value;
        $this->_setField('arkose');
        return $this;
    }

    /**
     * @return ?AttackProtectionCaptchaAuthChallengeResponseContent
     */
    public function getAuthChallenge(): ?AttackProtectionCaptchaAuthChallengeResponseContent
    {
        return $this->authChallenge;
    }

    /**
     * @param ?AttackProtectionCaptchaAuthChallengeResponseContent $value
     */
    public function setAuthChallenge(?AttackProtectionCaptchaAuthChallengeResponseContent $value = null): self
    {
        $this->authChallenge = $value;
        $this->_setField('authChallenge');
        return $this;
    }

    /**
     * @return ?AttackProtectionCaptchaHcaptchaResponseContent
     */
    public function getHcaptcha(): ?AttackProtectionCaptchaHcaptchaResponseContent
    {
        return $this->hcaptcha;
    }

    /**
     * @param ?AttackProtectionCaptchaHcaptchaResponseContent $value
     */
    public function setHcaptcha(?AttackProtectionCaptchaHcaptchaResponseContent $value = null): self
    {
        $this->hcaptcha = $value;
        $this->_setField('hcaptcha');
        return $this;
    }

    /**
     * @return ?AttackProtectionCaptchaFriendlyCaptchaResponseContent
     */
    public function getFriendlyCaptcha(): ?AttackProtectionCaptchaFriendlyCaptchaResponseContent
    {
        return $this->friendlyCaptcha;
    }

    /**
     * @param ?AttackProtectionCaptchaFriendlyCaptchaResponseContent $value
     */
    public function setFriendlyCaptcha(?AttackProtectionCaptchaFriendlyCaptchaResponseContent $value = null): self
    {
        $this->friendlyCaptcha = $value;
        $this->_setField('friendlyCaptcha');
        return $this;
    }

    /**
     * @return ?AttackProtectionCaptchaRecaptchaEnterpriseResponseContent
     */
    public function getRecaptchaEnterprise(): ?AttackProtectionCaptchaRecaptchaEnterpriseResponseContent
    {
        return $this->recaptchaEnterprise;
    }

    /**
     * @param ?AttackProtectionCaptchaRecaptchaEnterpriseResponseContent $value
     */
    public function setRecaptchaEnterprise(?AttackProtectionCaptchaRecaptchaEnterpriseResponseContent $value = null): self
    {
        $this->recaptchaEnterprise = $value;
        $this->_setField('recaptchaEnterprise');
        return $this;
    }

    /**
     * @return ?AttackProtectionCaptchaRecaptchaV2ResponseContent
     */
    public function getRecaptchaV2(): ?AttackProtectionCaptchaRecaptchaV2ResponseContent
    {
        return $this->recaptchaV2;
    }

    /**
     * @param ?AttackProtectionCaptchaRecaptchaV2ResponseContent $value
     */
    public function setRecaptchaV2(?AttackProtectionCaptchaRecaptchaV2ResponseContent $value = null): self
    {
        $this->recaptchaV2 = $value;
        $this->_setField('recaptchaV2');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getSimpleCaptcha(): ?array
    {
        return $this->simpleCaptcha;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setSimpleCaptcha(?array $value = null): self
    {
        $this->simpleCaptcha = $value;
        $this->_setField('simpleCaptcha');
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
