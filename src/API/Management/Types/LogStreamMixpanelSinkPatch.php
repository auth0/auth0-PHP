<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class LogStreamMixpanelSinkPatch extends JsonSerializableType
{
    /**
     * @var value-of<LogStreamMixpanelRegionEnum> $mixpanelRegion
     */
    #[JsonProperty('mixpanelRegion')]
    private string $mixpanelRegion;

    /**
     * @var string $mixpanelProjectId Mixpanel Project Id
     */
    #[JsonProperty('mixpanelProjectId')]
    private string $mixpanelProjectId;

    /**
     * @var string $mixpanelServiceAccountUsername Mixpanel Service Account Username
     */
    #[JsonProperty('mixpanelServiceAccountUsername')]
    private string $mixpanelServiceAccountUsername;

    /**
     * @var ?string $mixpanelServiceAccountPassword Mixpanel Service Account Password
     */
    #[JsonProperty('mixpanelServiceAccountPassword')]
    private ?string $mixpanelServiceAccountPassword;

    /**
     * @param array{
     *   mixpanelRegion: value-of<LogStreamMixpanelRegionEnum>,
     *   mixpanelProjectId: string,
     *   mixpanelServiceAccountUsername: string,
     *   mixpanelServiceAccountPassword?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mixpanelRegion = $values['mixpanelRegion'];
        $this->mixpanelProjectId = $values['mixpanelProjectId'];
        $this->mixpanelServiceAccountUsername = $values['mixpanelServiceAccountUsername'];
        $this->mixpanelServiceAccountPassword = $values['mixpanelServiceAccountPassword'] ?? null;
    }

    /**
     * @return value-of<LogStreamMixpanelRegionEnum>
     */
    public function getMixpanelRegion(): string
    {
        return $this->mixpanelRegion;
    }

    /**
     * @param value-of<LogStreamMixpanelRegionEnum> $value
     */
    public function setMixpanelRegion(string $value): self
    {
        $this->mixpanelRegion = $value;
        $this->_setField('mixpanelRegion');
        return $this;
    }

    /**
     * @return string
     */
    public function getMixpanelProjectId(): string
    {
        return $this->mixpanelProjectId;
    }

    /**
     * @param string $value
     */
    public function setMixpanelProjectId(string $value): self
    {
        $this->mixpanelProjectId = $value;
        $this->_setField('mixpanelProjectId');
        return $this;
    }

    /**
     * @return string
     */
    public function getMixpanelServiceAccountUsername(): string
    {
        return $this->mixpanelServiceAccountUsername;
    }

    /**
     * @param string $value
     */
    public function setMixpanelServiceAccountUsername(string $value): self
    {
        $this->mixpanelServiceAccountUsername = $value;
        $this->_setField('mixpanelServiceAccountUsername');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMixpanelServiceAccountPassword(): ?string
    {
        return $this->mixpanelServiceAccountPassword;
    }

    /**
     * @param ?string $value
     */
    public function setMixpanelServiceAccountPassword(?string $value = null): self
    {
        $this->mixpanelServiceAccountPassword = $value;
        $this->_setField('mixpanelServiceAccountPassword');
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
