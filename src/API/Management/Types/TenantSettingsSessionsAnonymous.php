<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Anonymous session settings for tenant.
 */
class TenantSettingsSessionsAnonymous extends JsonSerializableType
{
    /**
     * @var ?int $lifetimeInMinutes Anonymous session lifetime, in minutes. Defaults to 43200 (30 days); maximum 525600 (1 year).
     */
    #[JsonProperty('lifetime_in_minutes')]
    private ?int $lifetimeInMinutes;

    /**
     * @var ?bool $activateCookie Whether anonymous session requests return the `auth0_anon` cookie. Defaults to enabled; set to false to stop issuing the cookie.
     */
    #[JsonProperty('activate_cookie')]
    private ?bool $activateCookie;

    /**
     * @param array{
     *   lifetimeInMinutes?: ?int,
     *   activateCookie?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->lifetimeInMinutes = $values['lifetimeInMinutes'] ?? null;
        $this->activateCookie = $values['activateCookie'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getLifetimeInMinutes(): ?int
    {
        return $this->lifetimeInMinutes;
    }

    /**
     * @param ?int $value
     */
    public function setLifetimeInMinutes(?int $value = null): self
    {
        $this->lifetimeInMinutes = $value;
        $this->_setField('lifetimeInMinutes');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getActivateCookie(): ?bool
    {
        return $this->activateCookie;
    }

    /**
     * @param ?bool $value
     */
    public function setActivateCookie(?bool $value = null): self
    {
        $this->activateCookie = $value;
        $this->_setField('activateCookie');
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
