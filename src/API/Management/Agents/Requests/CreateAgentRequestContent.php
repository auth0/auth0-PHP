<?php

namespace Auth0\SDK\API\Management\Agents\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateAgentRequestContent extends JsonSerializableType
{
    /**
     * @var string $name The agent name. Cannot contain <, >, or null bytes.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $clientId Optional client ID to associate with the agent
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $externalAgentId Optional external identifier for the agent. Immutable after creation. Must be unique within the tenant.
     */
    #[JsonProperty('external_agent_id')]
    private ?string $externalAgentId;

    /**
     * @var ?array<string, mixed> $metadata
     */
    #[JsonProperty('metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $metadata;

    /**
     * @param array{
     *   name: string,
     *   clientId?: ?string,
     *   externalAgentId?: ?string,
     *   metadata?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->clientId = $values['clientId'] ?? null;
        $this->externalAgentId = $values['externalAgentId'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExternalAgentId(): ?string
    {
        return $this->externalAgentId;
    }

    /**
     * @param ?string $value
     */
    public function setExternalAgentId(?string $value = null): self
    {
        $this->externalAgentId = $value;
        $this->_setField('externalAgentId');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setMetadata(?array $value = null): self
    {
        $this->metadata = $value;
        $this->_setField('metadata');
        return $this;
    }
}
