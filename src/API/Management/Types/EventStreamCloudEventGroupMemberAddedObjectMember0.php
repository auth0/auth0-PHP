<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * A group member of member_type user
 */
class EventStreamCloudEventGroupMemberAddedObjectMember0 extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamCloudEventGroupMemberAddedObjectMember0MemberTypeEnum> $memberType
     */
    #[JsonProperty('member_type')]
    private string $memberType;

    /**
     * @var string $id The user's unique identifier
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @param array{
     *   memberType: value-of<EventStreamCloudEventGroupMemberAddedObjectMember0MemberTypeEnum>,
     *   id: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->memberType = $values['memberType'];
        $this->id = $values['id'];
    }

    /**
     * @return value-of<EventStreamCloudEventGroupMemberAddedObjectMember0MemberTypeEnum>
     */
    public function getMemberType(): string
    {
        return $this->memberType;
    }

    /**
     * @param value-of<EventStreamCloudEventGroupMemberAddedObjectMember0MemberTypeEnum> $value
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
    public function __toString(): string
    {
        return $this->toJson();
    }
}
