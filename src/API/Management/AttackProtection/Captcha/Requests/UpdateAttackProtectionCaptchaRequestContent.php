<?php

namespace Auth0\SDK\API\Management\AttackProtection\Captcha\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\AttackProtectionCaptchaProviderId;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\AttackProtectionUpdateCaptchaArkose;
use Auth0\SDK\API\Management\Types\AttackProtectionCaptchaAuthChallengeRequest;
use Auth0\SDK\API\Management\Types\AttackProtectionUpdateCaptchaHcaptcha;
use Auth0\SDK\API\Management\Types\AttackProtectionUpdateCaptchaFriendlyCaptcha;
use Auth0\SDK\API\Management\Types\AttackProtectionUpdateCaptchaRecaptchaEnterprise;
use Auth0\SDK\API\Management\Types\AttackProtectionUpdateCaptchaRecaptchaV2;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateAttackProtectionCaptchaRequestContent extends JsonSerializableType
{
    /**
     * @var ?value-of<AttackProtectionCaptchaProviderId> $activeProviderId
     */
    #[JsonProperty('active_provider_id')]
    private ?string $activeProviderId;

    /**
     * @var ?AttackProtectionUpdateCaptchaArkose $arkose
     */
    #[JsonProperty('arkose')]
    private ?AttackProtectionUpdateCaptchaArkose $arkose;

    /**
     * @var ?AttackProtectionCaptchaAuthChallengeRequest $authChallenge
     */
    #[JsonProperty('auth_challenge')]
    private ?AttackProtectionCaptchaAuthChallengeRequest $authChallenge;

    /**
     * @var ?AttackProtectionUpdateCaptchaHcaptcha $hcaptcha
     */
    #[JsonProperty('hcaptcha')]
    private ?AttackProtectionUpdateCaptchaHcaptcha $hcaptcha;

    /**
     * @var ?AttackProtectionUpdateCaptchaFriendlyCaptcha $friendlyCaptcha
     */
    #[JsonProperty('friendly_captcha')]
    private ?AttackProtectionUpdateCaptchaFriendlyCaptcha $friendlyCaptcha;

    /**
     * @var ?AttackProtectionUpdateCaptchaRecaptchaEnterprise $recaptchaEnterprise
     */
    #[JsonProperty('recaptcha_enterprise')]
    private ?AttackProtectionUpdateCaptchaRecaptchaEnterprise $recaptchaEnterprise;

    /**
     * @var ?AttackProtectionUpdateCaptchaRecaptchaV2 $recaptchaV2
     */
    #[JsonProperty('recaptcha_v2')]
    private ?AttackProtectionUpdateCaptchaRecaptchaV2 $recaptchaV2;

    /**
     * @var ?array<string, mixed> $simpleCaptcha
     */
    #[JsonProperty('simple_captcha'), ArrayType(['string' => 'mixed'])]
    private ?array $simpleCaptcha;

    /**
     * @param array{
     *   activeProviderId?: ?value-of<AttackProtectionCaptchaProviderId>,
     *   arkose?: ?AttackProtectionUpdateCaptchaArkose,
     *   authChallenge?: ?AttackProtectionCaptchaAuthChallengeRequest,
     *   hcaptcha?: ?AttackProtectionUpdateCaptchaHcaptcha,
     *   friendlyCaptcha?: ?AttackProtectionUpdateCaptchaFriendlyCaptcha,
     *   recaptchaEnterprise?: ?AttackProtectionUpdateCaptchaRecaptchaEnterprise,
     *   recaptchaV2?: ?AttackProtectionUpdateCaptchaRecaptchaV2,
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
     * @return ?value-of<AttackProtectionCaptchaProviderId>
     */
    public function getActiveProviderId(): ?string
    {
        return $this->activeProviderId;
    }

    /**
     * @param ?value-of<AttackProtectionCaptchaProviderId> $value
     */
    public function setActiveProviderId(?string $value = null): self
    {
        $this->activeProviderId = $value;
        $this->_setField('activeProviderId');
        return $this;
    }

    /**
     * @return ?AttackProtectionUpdateCaptchaArkose
     */
    public function getArkose(): ?AttackProtectionUpdateCaptchaArkose
    {
        return $this->arkose;
    }

    /**
     * @param ?AttackProtectionUpdateCaptchaArkose $value
     */
    public function setArkose(?AttackProtectionUpdateCaptchaArkose $value = null): self
    {
        $this->arkose = $value;
        $this->_setField('arkose');
        return $this;
    }

    /**
     * @return ?AttackProtectionCaptchaAuthChallengeRequest
     */
    public function getAuthChallenge(): ?AttackProtectionCaptchaAuthChallengeRequest
    {
        return $this->authChallenge;
    }

    /**
     * @param ?AttackProtectionCaptchaAuthChallengeRequest $value
     */
    public function setAuthChallenge(?AttackProtectionCaptchaAuthChallengeRequest $value = null): self
    {
        $this->authChallenge = $value;
        $this->_setField('authChallenge');
        return $this;
    }

    /**
     * @return ?AttackProtectionUpdateCaptchaHcaptcha
     */
    public function getHcaptcha(): ?AttackProtectionUpdateCaptchaHcaptcha
    {
        return $this->hcaptcha;
    }

    /**
     * @param ?AttackProtectionUpdateCaptchaHcaptcha $value
     */
    public function setHcaptcha(?AttackProtectionUpdateCaptchaHcaptcha $value = null): self
    {
        $this->hcaptcha = $value;
        $this->_setField('hcaptcha');
        return $this;
    }

    /**
     * @return ?AttackProtectionUpdateCaptchaFriendlyCaptcha
     */
    public function getFriendlyCaptcha(): ?AttackProtectionUpdateCaptchaFriendlyCaptcha
    {
        return $this->friendlyCaptcha;
    }

    /**
     * @param ?AttackProtectionUpdateCaptchaFriendlyCaptcha $value
     */
    public function setFriendlyCaptcha(?AttackProtectionUpdateCaptchaFriendlyCaptcha $value = null): self
    {
        $this->friendlyCaptcha = $value;
        $this->_setField('friendlyCaptcha');
        return $this;
    }

    /**
     * @return ?AttackProtectionUpdateCaptchaRecaptchaEnterprise
     */
    public function getRecaptchaEnterprise(): ?AttackProtectionUpdateCaptchaRecaptchaEnterprise
    {
        return $this->recaptchaEnterprise;
    }

    /**
     * @param ?AttackProtectionUpdateCaptchaRecaptchaEnterprise $value
     */
    public function setRecaptchaEnterprise(?AttackProtectionUpdateCaptchaRecaptchaEnterprise $value = null): self
    {
        $this->recaptchaEnterprise = $value;
        $this->_setField('recaptchaEnterprise');
        return $this;
    }

    /**
     * @return ?AttackProtectionUpdateCaptchaRecaptchaV2
     */
    public function getRecaptchaV2(): ?AttackProtectionUpdateCaptchaRecaptchaV2
    {
        return $this->recaptchaV2;
    }

    /**
     * @param ?AttackProtectionUpdateCaptchaRecaptchaV2 $value
     */
    public function setRecaptchaV2(?AttackProtectionUpdateCaptchaRecaptchaV2 $value = null): self
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
}
