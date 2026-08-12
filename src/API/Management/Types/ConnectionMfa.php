<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Multi-factor authentication configuration
 */
class ConnectionMfa extends JsonSerializableType
{
    /**
     * @var ?bool $active Indicates whether MFA is active for this connection
     */
    #[JsonProperty('active')]
    private ?bool $active;

    /**
     * @var ?bool $returnEnrollSettings Indicates whether to return MFA enrollment settings
     */
    #[JsonProperty('return_enroll_settings')]
    private ?bool $returnEnrollSettings;

    /**
     * @param array{
     *   active?: ?bool,
     *   returnEnrollSettings?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->active = $values['active'] ?? null;
        $this->returnEnrollSettings = $values['returnEnrollSettings'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param ?bool $value
     */
    public function setActive(?bool $value = null): self
    {
        $this->active = $value;
        $this->_setField('active');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getReturnEnrollSettings(): ?bool
    {
        return $this->returnEnrollSettings;
    }

    /**
     * @param ?bool $value
     */
    public function setReturnEnrollSettings(?bool $value = null): self
    {
        $this->returnEnrollSettings = $value;
        $this->_setField('returnEnrollSettings');
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
