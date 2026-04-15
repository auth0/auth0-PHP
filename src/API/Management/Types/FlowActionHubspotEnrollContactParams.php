<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class FlowActionHubspotEnrollContactParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $email
     */
    #[JsonProperty('email')]
    private string $email;

    /**
     * @var (
     *    string
     *   |int
     * ) $workflowId
     */
    #[JsonProperty('workflow_id'), Union('string', 'integer')]
    private string|int $workflowId;

    /**
     * @param array{
     *   connectionId: string,
     *   email: string,
     *   workflowId: (
     *    string
     *   |int
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->email = $values['email'];
        $this->workflowId = $values['workflowId'];
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $value
     */
    public function setEmail(string $value): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |int
     * )
     */
    public function getWorkflowId(): string|int
    {
        return $this->workflowId;
    }

    /**
     * @param (
     *    string
     *   |int
     * ) $value
     */
    public function setWorkflowId(string|int $value): self
    {
        $this->workflowId = $value;
        $this->_setField('workflowId');
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
