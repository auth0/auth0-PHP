<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionSalesforceGetLeadParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $leadId
     */
    #[JsonProperty('lead_id')]
    private string $leadId;

    /**
     * @param array{
     *   connectionId: string,
     *   leadId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->leadId = $values['leadId'];
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
    public function getLeadId(): string
    {
        return $this->leadId;
    }

    /**
     * @param string $value
     */
    public function setLeadId(string $value): self
    {
        $this->leadId = $value;
        $this->_setField('leadId');
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
