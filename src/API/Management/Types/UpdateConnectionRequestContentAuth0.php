<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Update a connection with strategy=auth0
 */
class UpdateConnectionRequestContentAuth0 extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsAuth0 $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsAuth0 $options;

    /**
     * @var ?array<string> $realms
     */
    #[JsonProperty('realms'), ArrayType(['string'])]
    private ?array $realms;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsAuth0,
     *   realms?: ?array<string>,
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
        $this->realms = $values['realms'] ?? null;
    }

    /**
     * @return ?ConnectionOptionsAuth0
     */
    public function getOptions(): ?ConnectionOptionsAuth0
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsAuth0 $value
     */
    public function setOptions(?ConnectionOptionsAuth0 $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getRealms(): ?array
    {
        return $this->realms;
    }

    /**
     * @param ?array<string> $value
     */
    public function setRealms(?array $value = null): self
    {
        $this->realms = $value;
        $this->_setField('realms');
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
