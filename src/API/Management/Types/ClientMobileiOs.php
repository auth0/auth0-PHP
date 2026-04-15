<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * iOS native app configuration.
 */
class ClientMobileiOs extends JsonSerializableType
{
    /**
     * @var ?string $teamId Identifier assigned to the Apple account that signs and uploads the app to the store.
     */
    #[JsonProperty('team_id')]
    private ?string $teamId;

    /**
     * @var ?string $appBundleIdentifier Assigned by developer to the app as its unique identifier inside the store. Usually this is a reverse domain plus the app name, e.g. `com.you.MyApp`.
     */
    #[JsonProperty('app_bundle_identifier')]
    private ?string $appBundleIdentifier;

    /**
     * @param array{
     *   teamId?: ?string,
     *   appBundleIdentifier?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->teamId = $values['teamId'] ?? null;
        $this->appBundleIdentifier = $values['appBundleIdentifier'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getTeamId(): ?string
    {
        return $this->teamId;
    }

    /**
     * @param ?string $value
     */
    public function setTeamId(?string $value = null): self
    {
        $this->teamId = $value;
        $this->_setField('teamId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAppBundleIdentifier(): ?string
    {
        return $this->appBundleIdentifier;
    }

    /**
     * @param ?string $value
     */
    public function setAppBundleIdentifier(?string $value = null): self
    {
        $this->appBundleIdentifier = $value;
        $this->_setField('appBundleIdentifier');
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
