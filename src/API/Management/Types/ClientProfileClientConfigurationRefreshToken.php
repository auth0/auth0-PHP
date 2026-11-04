<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Refresh token settings. Omit any sub-field to use the client's own value.
 */
class ClientProfileClientConfigurationRefreshToken extends JsonSerializableType
{
    /**
     * @var ?ClientProfileRefreshTokenTokenLifetime $tokenLifetime
     */
    #[JsonProperty('token_lifetime')]
    private ?ClientProfileRefreshTokenTokenLifetime $tokenLifetime;

    /**
     * @var ?ClientProfileRefreshTokenIdleTokenLifetime $idleTokenLifetime
     */
    #[JsonProperty('idle_token_lifetime')]
    private ?ClientProfileRefreshTokenIdleTokenLifetime $idleTokenLifetime;

    /**
     * @var ?ClientProfileRefreshTokenLeeway $leeway
     */
    #[JsonProperty('leeway')]
    private ?ClientProfileRefreshTokenLeeway $leeway;

    /**
     * @param array{
     *   tokenLifetime?: ?ClientProfileRefreshTokenTokenLifetime,
     *   idleTokenLifetime?: ?ClientProfileRefreshTokenIdleTokenLifetime,
     *   leeway?: ?ClientProfileRefreshTokenLeeway,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->tokenLifetime = $values['tokenLifetime'] ?? null;
        $this->idleTokenLifetime = $values['idleTokenLifetime'] ?? null;
        $this->leeway = $values['leeway'] ?? null;
    }

    /**
     * @return ?ClientProfileRefreshTokenTokenLifetime
     */
    public function getTokenLifetime(): ?ClientProfileRefreshTokenTokenLifetime
    {
        return $this->tokenLifetime;
    }

    /**
     * @param ?ClientProfileRefreshTokenTokenLifetime $value
     */
    public function setTokenLifetime(?ClientProfileRefreshTokenTokenLifetime $value = null): self
    {
        $this->tokenLifetime = $value;
        $this->_setField('tokenLifetime');
        return $this;
    }

    /**
     * @return ?ClientProfileRefreshTokenIdleTokenLifetime
     */
    public function getIdleTokenLifetime(): ?ClientProfileRefreshTokenIdleTokenLifetime
    {
        return $this->idleTokenLifetime;
    }

    /**
     * @param ?ClientProfileRefreshTokenIdleTokenLifetime $value
     */
    public function setIdleTokenLifetime(?ClientProfileRefreshTokenIdleTokenLifetime $value = null): self
    {
        $this->idleTokenLifetime = $value;
        $this->_setField('idleTokenLifetime');
        return $this;
    }

    /**
     * @return ?ClientProfileRefreshTokenLeeway
     */
    public function getLeeway(): ?ClientProfileRefreshTokenLeeway
    {
        return $this->leeway;
    }

    /**
     * @param ?ClientProfileRefreshTokenLeeway $value
     */
    public function setLeeway(?ClientProfileRefreshTokenLeeway $value = null): self
    {
        $this->leeway = $value;
        $this->_setField('leeway');
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
