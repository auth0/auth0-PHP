<?php

namespace Auth0\SDK\API\Management\AttackProtection\BotDetection\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\BotDetectionLevelEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\BotDetectionChallengePolicyPasswordFlowEnum;
use Auth0\SDK\API\Management\Types\BotDetectionChallengePolicyPasswordlessFlowEnum;
use Auth0\SDK\API\Management\Types\BotDetectionChallengePolicyPasswordResetFlowEnum;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateBotDetectionSettingsRequestContent extends JsonSerializableType
{
    /**
     * @var ?value-of<BotDetectionLevelEnum> $botDetectionLevel
     */
    #[JsonProperty('bot_detection_level')]
    private ?string $botDetectionLevel;

    /**
     * @var ?value-of<BotDetectionChallengePolicyPasswordFlowEnum> $challengePasswordPolicy
     */
    #[JsonProperty('challenge_password_policy')]
    private ?string $challengePasswordPolicy;

    /**
     * @var ?value-of<BotDetectionChallengePolicyPasswordlessFlowEnum> $challengePasswordlessPolicy
     */
    #[JsonProperty('challenge_passwordless_policy')]
    private ?string $challengePasswordlessPolicy;

    /**
     * @var ?value-of<BotDetectionChallengePolicyPasswordResetFlowEnum> $challengePasswordResetPolicy
     */
    #[JsonProperty('challenge_password_reset_policy')]
    private ?string $challengePasswordResetPolicy;

    /**
     * @var ?array<string> $allowlist
     */
    #[JsonProperty('allowlist'), ArrayType(['string'])]
    private ?array $allowlist;

    /**
     * @var ?bool $monitoringModeEnabled
     */
    #[JsonProperty('monitoring_mode_enabled')]
    private ?bool $monitoringModeEnabled;

    /**
     * @param array{
     *   botDetectionLevel?: ?value-of<BotDetectionLevelEnum>,
     *   challengePasswordPolicy?: ?value-of<BotDetectionChallengePolicyPasswordFlowEnum>,
     *   challengePasswordlessPolicy?: ?value-of<BotDetectionChallengePolicyPasswordlessFlowEnum>,
     *   challengePasswordResetPolicy?: ?value-of<BotDetectionChallengePolicyPasswordResetFlowEnum>,
     *   allowlist?: ?array<string>,
     *   monitoringModeEnabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->botDetectionLevel = $values['botDetectionLevel'] ?? null;
        $this->challengePasswordPolicy = $values['challengePasswordPolicy'] ?? null;
        $this->challengePasswordlessPolicy = $values['challengePasswordlessPolicy'] ?? null;
        $this->challengePasswordResetPolicy = $values['challengePasswordResetPolicy'] ?? null;
        $this->allowlist = $values['allowlist'] ?? null;
        $this->monitoringModeEnabled = $values['monitoringModeEnabled'] ?? null;
    }

    /**
     * @return ?value-of<BotDetectionLevelEnum>
     */
    public function getBotDetectionLevel(): ?string
    {
        return $this->botDetectionLevel;
    }

    /**
     * @param ?value-of<BotDetectionLevelEnum> $value
     */
    public function setBotDetectionLevel(?string $value = null): self
    {
        $this->botDetectionLevel = $value;
        $this->_setField('botDetectionLevel');
        return $this;
    }

    /**
     * @return ?value-of<BotDetectionChallengePolicyPasswordFlowEnum>
     */
    public function getChallengePasswordPolicy(): ?string
    {
        return $this->challengePasswordPolicy;
    }

    /**
     * @param ?value-of<BotDetectionChallengePolicyPasswordFlowEnum> $value
     */
    public function setChallengePasswordPolicy(?string $value = null): self
    {
        $this->challengePasswordPolicy = $value;
        $this->_setField('challengePasswordPolicy');
        return $this;
    }

    /**
     * @return ?value-of<BotDetectionChallengePolicyPasswordlessFlowEnum>
     */
    public function getChallengePasswordlessPolicy(): ?string
    {
        return $this->challengePasswordlessPolicy;
    }

    /**
     * @param ?value-of<BotDetectionChallengePolicyPasswordlessFlowEnum> $value
     */
    public function setChallengePasswordlessPolicy(?string $value = null): self
    {
        $this->challengePasswordlessPolicy = $value;
        $this->_setField('challengePasswordlessPolicy');
        return $this;
    }

    /**
     * @return ?value-of<BotDetectionChallengePolicyPasswordResetFlowEnum>
     */
    public function getChallengePasswordResetPolicy(): ?string
    {
        return $this->challengePasswordResetPolicy;
    }

    /**
     * @param ?value-of<BotDetectionChallengePolicyPasswordResetFlowEnum> $value
     */
    public function setChallengePasswordResetPolicy(?string $value = null): self
    {
        $this->challengePasswordResetPolicy = $value;
        $this->_setField('challengePasswordResetPolicy');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getAllowlist(): ?array
    {
        return $this->allowlist;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAllowlist(?array $value = null): self
    {
        $this->allowlist = $value;
        $this->_setField('allowlist');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getMonitoringModeEnabled(): ?bool
    {
        return $this->monitoringModeEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setMonitoringModeEnabled(?bool $value = null): self
    {
        $this->monitoringModeEnabled = $value;
        $this->_setField('monitoringModeEnabled');
        return $this;
    }
}
