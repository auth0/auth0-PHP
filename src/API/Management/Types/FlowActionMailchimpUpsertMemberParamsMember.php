<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionMailchimpUpsertMemberParamsMember extends JsonSerializableType
{
    /**
     * @var string $emailAddress
     */
    #[JsonProperty('email_address')]
    private string $emailAddress;

    /**
     * @var string $statusIfNew
     */
    #[JsonProperty('status_if_new')]
    private string $statusIfNew;

    /**
     * @var ?array<string, mixed> $mergeFields
     */
    #[JsonProperty('merge_fields'), ArrayType(['string' => 'mixed'])]
    private ?array $mergeFields;

    /**
     * @param array{
     *   emailAddress: string,
     *   statusIfNew: string,
     *   mergeFields?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->emailAddress = $values['emailAddress'];
        $this->statusIfNew = $values['statusIfNew'];
        $this->mergeFields = $values['mergeFields'] ?? null;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $value
     */
    public function setEmailAddress(string $value): self
    {
        $this->emailAddress = $value;
        $this->_setField('emailAddress');
        return $this;
    }

    /**
     * @return string
     */
    public function getStatusIfNew(): string
    {
        return $this->statusIfNew;
    }

    /**
     * @param string $value
     */
    public function setStatusIfNew(string $value): self
    {
        $this->statusIfNew = $value;
        $this->_setField('statusIfNew');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getMergeFields(): ?array
    {
        return $this->mergeFields;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setMergeFields(?array $value = null): self
    {
        $this->mergeFields = $value;
        $this->_setField('mergeFields');
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
