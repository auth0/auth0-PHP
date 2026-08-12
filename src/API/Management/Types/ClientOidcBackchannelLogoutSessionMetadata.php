<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Controls whether session metadata is included in the logout token. Default value is null.
 */
class ClientOidcBackchannelLogoutSessionMetadata extends JsonSerializableType
{
    /**
     * @var ?bool $include The `include` property determines whether session metadata is included in the logout token.
     */
    #[JsonProperty('include')]
    private ?bool $include;

    /**
     * @param array{
     *   include?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->include = $values['include'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getInclude(): ?bool
    {
        return $this->include;
    }

    /**
     * @param ?bool $value
     */
    public function setInclude(?bool $value = null): self
    {
        $this->include = $value;
        $this->_setField('include');
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
