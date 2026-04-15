<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for the passkey authentication method
 */
class ConnectionPasskeyOptions extends JsonSerializableType
{
    /**
     * @var ?value-of<ConnectionPasskeyChallengeUiEnum> $challengeUi
     */
    #[JsonProperty('challenge_ui')]
    private ?string $challengeUi;

    /**
     * @var ?bool $progressiveEnrollmentEnabled Enables or disables progressive enrollment of passkeys for the connection.
     */
    #[JsonProperty('progressive_enrollment_enabled')]
    private ?bool $progressiveEnrollmentEnabled;

    /**
     * @var ?bool $localEnrollmentEnabled Enables or disables enrollment prompt for local passkey when user authenticates using a cross-device passkey for the connection.
     */
    #[JsonProperty('local_enrollment_enabled')]
    private ?bool $localEnrollmentEnabled;

    /**
     * @param array{
     *   challengeUi?: ?value-of<ConnectionPasskeyChallengeUiEnum>,
     *   progressiveEnrollmentEnabled?: ?bool,
     *   localEnrollmentEnabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->challengeUi = $values['challengeUi'] ?? null;
        $this->progressiveEnrollmentEnabled = $values['progressiveEnrollmentEnabled'] ?? null;
        $this->localEnrollmentEnabled = $values['localEnrollmentEnabled'] ?? null;
    }

    /**
     * @return ?value-of<ConnectionPasskeyChallengeUiEnum>
     */
    public function getChallengeUi(): ?string
    {
        return $this->challengeUi;
    }

    /**
     * @param ?value-of<ConnectionPasskeyChallengeUiEnum> $value
     */
    public function setChallengeUi(?string $value = null): self
    {
        $this->challengeUi = $value;
        $this->_setField('challengeUi');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getProgressiveEnrollmentEnabled(): ?bool
    {
        return $this->progressiveEnrollmentEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setProgressiveEnrollmentEnabled(?bool $value = null): self
    {
        $this->progressiveEnrollmentEnabled = $value;
        $this->_setField('progressiveEnrollmentEnabled');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getLocalEnrollmentEnabled(): ?bool
    {
        return $this->localEnrollmentEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setLocalEnrollmentEnabled(?bool $value = null): self
    {
        $this->localEnrollmentEnabled = $value;
        $this->_setField('localEnrollmentEnabled');
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
