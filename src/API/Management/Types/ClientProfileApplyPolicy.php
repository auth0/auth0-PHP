<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Runtime matching rules that determine which clients this profile governs.
 */
class ClientProfileApplyPolicy extends JsonSerializableType
{
    /**
     * @var value-of<ClientProfileApplyPolicyExternalMetadataTypeEnum> $externalMetadataType
     */
    #[JsonProperty('external_metadata_type')]
    private string $externalMetadataType;

    /**
     * @var value-of<ClientProfileApplyPolicyExternalMetadataCreatedByEnum> $externalMetadataCreatedBy
     */
    #[JsonProperty('external_metadata_created_by')]
    private string $externalMetadataCreatedBy;

    /**
     * @param array{
     *   externalMetadataType: value-of<ClientProfileApplyPolicyExternalMetadataTypeEnum>,
     *   externalMetadataCreatedBy: value-of<ClientProfileApplyPolicyExternalMetadataCreatedByEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->externalMetadataType = $values['externalMetadataType'];
        $this->externalMetadataCreatedBy = $values['externalMetadataCreatedBy'];
    }

    /**
     * @return value-of<ClientProfileApplyPolicyExternalMetadataTypeEnum>
     */
    public function getExternalMetadataType(): string
    {
        return $this->externalMetadataType;
    }

    /**
     * @param value-of<ClientProfileApplyPolicyExternalMetadataTypeEnum> $value
     */
    public function setExternalMetadataType(string $value): self
    {
        $this->externalMetadataType = $value;
        $this->_setField('externalMetadataType');
        return $this;
    }

    /**
     * @return value-of<ClientProfileApplyPolicyExternalMetadataCreatedByEnum>
     */
    public function getExternalMetadataCreatedBy(): string
    {
        return $this->externalMetadataCreatedBy;
    }

    /**
     * @param value-of<ClientProfileApplyPolicyExternalMetadataCreatedByEnum> $value
     */
    public function setExternalMetadataCreatedBy(string $value): self
    {
        $this->externalMetadataCreatedBy = $value;
        $this->_setField('externalMetadataCreatedBy');
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
