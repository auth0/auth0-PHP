<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionMailchimpUpsertMemberParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $listId
     */
    #[JsonProperty('list_id')]
    private string $listId;

    /**
     * @var FlowActionMailchimpUpsertMemberParamsMember $member
     */
    #[JsonProperty('member')]
    private FlowActionMailchimpUpsertMemberParamsMember $member;

    /**
     * @param array{
     *   connectionId: string,
     *   listId: string,
     *   member: FlowActionMailchimpUpsertMemberParamsMember,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->listId = $values['listId'];
        $this->member = $values['member'];
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
    public function getListId(): string
    {
        return $this->listId;
    }

    /**
     * @param string $value
     */
    public function setListId(string $value): self
    {
        $this->listId = $value;
        $this->_setField('listId');
        return $this;
    }

    /**
     * @return FlowActionMailchimpUpsertMemberParamsMember
     */
    public function getMember(): FlowActionMailchimpUpsertMemberParamsMember
    {
        return $this->member;
    }

    /**
     * @param FlowActionMailchimpUpsertMemberParamsMember $value
     */
    public function setMember(FlowActionMailchimpUpsertMemberParamsMember $value): self
    {
        $this->member = $value;
        $this->_setField('member');
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
