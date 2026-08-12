<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class AgentResponseContent extends JsonSerializableType
{
    /**
     * @var string $agentId The agent ID
     */
    #[JsonProperty('agent_id')]
    private string $agentId;

    /**
     * @var string $name The agent name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var DateTime $createdAt When the agent was created
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt When the agent was last updated
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @var ?string $externalAgentId External identifier for the agent, if set. Omitted when not set.
     */
    #[JsonProperty('external_agent_id')]
    private ?string $externalAgentId;

    /**
     * @var array<string, mixed> $metadata
     */
    #[JsonProperty('metadata'), ArrayType(['string' => 'mixed'])]
    private array $metadata;

    /**
     * @param array{
     *   agentId: string,
     *   name: string,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   metadata: array<string, mixed>,
     *   externalAgentId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->agentId = $values['agentId'];
        $this->name = $values['name'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->externalAgentId = $values['externalAgentId'] ?? null;
        $this->metadata = $values['metadata'];
    }

    /**
     * @return string
     */
    public function getAgentId(): string
    {
        return $this->agentId;
    }

    /**
     * @param string $value
     */
    public function setAgentId(string $value): self
    {
        $this->agentId = $value;
        $this->_setField('agentId');
        return $this;
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
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
     * @return array<string, mixed>
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param array<string, mixed> $value
     */
    public function setMetadata(array $value): self
    {
        $this->metadata = $value;
        $this->_setField('metadata');
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
