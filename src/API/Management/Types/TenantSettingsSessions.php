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
     * @param array{
     *   oidcLogoutPromptEnabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->oidcLogoutPromptEnabled = $values['oidcLogoutPromptEnabled'] ?? null;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
