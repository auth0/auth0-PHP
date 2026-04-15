<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=auth0-oidc
 */
class UpdateConnectionRequestContentAuth0Oidc extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsAuth0Oidc $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsAuth0Oidc $options;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsAuth0Oidc,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->displayName = $values['displayName'] ?? null;
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->options = $values['options'] ?? null;
    }

    /**
     * @return ?ConnectionOptionsAuth0Oidc
     */
    public function getOptions(): ?ConnectionOptionsAuth0Oidc
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsAuth0Oidc $value
     */
    public function setOptions(?ConnectionOptionsAuth0Oidc $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
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
