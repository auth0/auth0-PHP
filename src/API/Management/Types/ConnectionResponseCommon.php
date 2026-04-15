<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\CreateConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ConnectionResponseCommon extends JsonSerializableType
{
    use CreateConnectionCommon;

    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?array<string> $realms
     */
    #[JsonProperty('realms'), ArrayType(['string'])]
    private ?array $realms;

    /**
     * @param array{
     *   name: string,
     *   id: string,
     *   enabledClients?: ?array<string>,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   realms?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->id = $values['id'];
        $this->realms = $values['realms'] ?? null;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
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
