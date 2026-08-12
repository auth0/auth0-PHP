<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionSendgridSendEmailParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var FlowActionSendgridSendEmailParamsPerson $from
     */
    #[JsonProperty('from')]
    private FlowActionSendgridSendEmailParamsPerson $from;

    /**
     * @var array<mixed> $personalizations
     */
    #[JsonProperty('personalizations'), ArrayType(['mixed'])]
    private array $personalizations;

    /**
     * @param array{
     *   connectionId: string,
     *   from: FlowActionSendgridSendEmailParamsPerson,
     *   personalizations: array<mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->from = $values['from'];
        $this->personalizations = $values['personalizations'];
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
     * @return FlowActionSendgridSendEmailParamsPerson
     */
    public function getFrom(): FlowActionSendgridSendEmailParamsPerson
    {
        return $this->from;
    }

    /**
     * @param FlowActionSendgridSendEmailParamsPerson $value
     */
    public function setFrom(FlowActionSendgridSendEmailParamsPerson $value): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return array<mixed>
     */
    public function getPersonalizations(): array
    {
        return $this->personalizations;
    }

    /**
     * @param array<mixed> $value
     */
    public function setPersonalizations(array $value): self
    {
        $this->personalizations = $value;
        $this->_setField('personalizations');
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
