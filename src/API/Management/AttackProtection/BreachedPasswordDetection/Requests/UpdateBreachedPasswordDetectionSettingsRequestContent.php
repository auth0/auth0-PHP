<?php

namespace Auth0\SDK\API\Management\AttackProtection\BreachedPasswordDetection\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\BreachedPasswordDetectionShieldsEnum;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\BreachedPasswordDetectionAdminNotificationFrequencyEnum;
use Auth0\SDK\API\Management\Types\BreachedPasswordDetectionMethodEnum;
use Auth0\SDK\API\Management\Types\BreachedPasswordDetectionStage;

class UpdateBreachedPasswordDetectionSettingsRequestContent extends JsonSerializableType
{
    /**
     * @var ?bool $enabled Whether or not breached password detection is active.
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * Action to take when a breached password is detected during a login.
     *       Possible values: <code>block</code>, <code>user_notification</code>, <code>admin_notification</code>.
     *
     * @var ?array<value-of<BreachedPasswordDetectionShieldsEnum>> $shields
     */
    #[JsonProperty('shields'), ArrayType(['string'])]
    private ?array $shields;

    /**
     * When "admin_notification" is enabled, determines how often email notifications are sent.
     *         Possible values: <code>immediately</code>, <code>daily</code>, <code>weekly</code>, <code>monthly</code>.
     *
     * @var ?array<value-of<BreachedPasswordDetectionAdminNotificationFrequencyEnum>> $adminNotificationFrequency
     */
    #[JsonProperty('admin_notification_frequency'), ArrayType(['string'])]
    private ?array $adminNotificationFrequency;

    /**
     * @var ?value-of<BreachedPasswordDetectionMethodEnum> $method
     */
    #[JsonProperty('method')]
    private ?string $method;

    /**
     * @var ?BreachedPasswordDetectionStage $stage
     */
    #[JsonProperty('stage')]
    private ?BreachedPasswordDetectionStage $stage;

    /**
     * @param array{
     *   enabled?: ?bool,
     *   shields?: ?array<value-of<BreachedPasswordDetectionShieldsEnum>>,
     *   adminNotificationFrequency?: ?array<value-of<BreachedPasswordDetectionAdminNotificationFrequencyEnum>>,
     *   method?: ?value-of<BreachedPasswordDetectionMethodEnum>,
     *   stage?: ?BreachedPasswordDetectionStage,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabled = $values['enabled'] ?? null;
        $this->shields = $values['shields'] ?? null;
        $this->adminNotificationFrequency = $values['adminNotificationFrequency'] ?? null;
        $this->method = $values['method'] ?? null;
        $this->stage = $values['stage'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
        return $this;
    }

    /**
     * @return ?array<value-of<BreachedPasswordDetectionShieldsEnum>>
     */
    public function getShields(): ?array
    {
        return $this->shields;
    }

    /**
     * @param ?array<value-of<BreachedPasswordDetectionShieldsEnum>> $value
     */
    public function setShields(?array $value = null): self
    {
        $this->shields = $value;
        $this->_setField('shields');
        return $this;
    }

    /**
     * @return ?array<value-of<BreachedPasswordDetectionAdminNotificationFrequencyEnum>>
     */
    public function getAdminNotificationFrequency(): ?array
    {
        return $this->adminNotificationFrequency;
    }

    /**
     * @param ?array<value-of<BreachedPasswordDetectionAdminNotificationFrequencyEnum>> $value
     */
    public function setAdminNotificationFrequency(?array $value = null): self
    {
        $this->adminNotificationFrequency = $value;
        $this->_setField('adminNotificationFrequency');
        return $this;
    }

    /**
     * @return ?value-of<BreachedPasswordDetectionMethodEnum>
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param ?value-of<BreachedPasswordDetectionMethodEnum> $value
     */
    public function setMethod(?string $value = null): self
    {
        $this->method = $value;
        $this->_setField('method');
        return $this;
    }

    /**
     * @return ?BreachedPasswordDetectionStage
     */
    public function getStage(): ?BreachedPasswordDetectionStage
    {
        return $this->stage;
    }

    /**
     * @param ?BreachedPasswordDetectionStage $value
     */
    public function setStage(?BreachedPasswordDetectionStage $value = null): self
    {
        $this->stage = $value;
        $this->_setField('stage');
        return $this;
    }
}
