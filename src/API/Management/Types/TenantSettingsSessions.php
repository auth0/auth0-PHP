<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Sessions related settings for tenant
 */
class TenantSettingsSessions extends JsonSerializableType
{
    /**
     * @var ?bool $oidcLogoutPromptEnabled Whether to bypass prompting logic (false) when performing OIDC Logout
     */
    #[JsonProperty('oidc_logout_prompt_enabled')]
    private ?bool $oidcLogoutPromptEnabled;

    /**
     * @var ?TenantSettingsSessionsAnonymous $anonymous
     */
    #[JsonProperty('anonymous')]
    private ?TenantSettingsSessionsAnonymous $anonymous;

    /**
     * @param array{
     *   oidcLogoutPromptEnabled?: ?bool,
     *   anonymous?: ?TenantSettingsSessionsAnonymous,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->oidcLogoutPromptEnabled = $values['oidcLogoutPromptEnabled'] ?? null;
        $this->anonymous = $values['anonymous'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getOidcLogoutPromptEnabled(): ?bool
    {
        return $this->oidcLogoutPromptEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setOidcLogoutPromptEnabled(?bool $value = null): self
    {
        $this->oidcLogoutPromptEnabled = $value;
        $this->_setField('oidcLogoutPromptEnabled');
        return $this;
    }

    /**
     * @return ?TenantSettingsSessionsAnonymous
     */
    public function getAnonymous(): ?TenantSettingsSessionsAnonymous
    {
        return $this->anonymous;
    }

    /**
     * @param ?TenantSettingsSessionsAnonymous $value
     */
    public function setAnonymous(?TenantSettingsSessionsAnonymous $value = null): self
    {
        $this->anonymous = $value;
        $this->_setField('anonymous');
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
