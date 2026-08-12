<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * A group member of member_type group
 */
class EventStreamCloudEventGroupMemberAddedObjectMember1 extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamCloudEventGroupMemberAddedObjectMember1MemberTypeEnum> $memberType
     */
    #[JsonProperty('member_type')]
    private string $memberType;

    /**
     * @var string $id The connection member's unique identifier
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $type The type of the connection
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $connectionId Connection ID associated with the member
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @param array{
     *   memberType: value-of<EventStreamCloudEventGroupMemberAddedObjectMember1MemberTypeEnum>,
     *   id: string,
     *   type: string,
     *   connectionId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->memberType = $values['memberType'];
        $this->id = $values['id'];
        $this->type = $values['type'];
        $this->connectionId = $values['connectionId'];
    }

    /**
     * @return value-of<EventStreamCloudEventGroupMemberAddedObjectMember1MemberTypeEnum>
     */
    public function getMemberType(): string
    {
        return $this->memberType;
    }

    /**
     * @param value-of<EventStreamCloudEventGroupMemberAddedObjectMember1MemberTypeEnum> $value
     */
    public function setMemberType(string $value): self
    {
        $this->memberType = $value;
        $this->_setField('memberType');
        return $this;
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
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
    public function __toString(): string
    {
        return $this->toJson();
    }
}
