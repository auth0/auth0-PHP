<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Response after successfully registering or updating a CIMD client
 */
class RegisterCimdClientResponseContent extends JsonSerializableType
{
    /**
     * @var string $clientId The Auth0 client_id of the created or updated client
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @var CimdMappedClientFields $mappedFields
     */
    #[JsonProperty('mapped_fields')]
    private CimdMappedClientFields $mappedFields;

    /**
     * @var CimdValidationResult $validation
     */
    #[JsonProperty('validation')]
    private CimdValidationResult $validation;

    /**
     * @param array{
     *   clientId: string,
     *   mappedFields: CimdMappedClientFields,
     *   validation: CimdValidationResult,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clientId = $values['clientId'];
        $this->mappedFields = $values['mappedFields'];
        $this->validation = $values['validation'];
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $value
     */
    public function setClientId(string $value): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return CimdMappedClientFields
     */
    public function getMappedFields(): CimdMappedClientFields
    {
        return $this->mappedFields;
    }

    /**
     * @param CimdMappedClientFields $value
     */
    public function setMappedFields(CimdMappedClientFields $value): self
    {
        $this->mappedFields = $value;
        $this->_setField('mappedFields');
        return $this;
    }

    /**
     * @return CimdValidationResult
     */
    public function getValidation(): CimdValidationResult
    {
        return $this->validation;
    }

    /**
     * @param CimdValidationResult $value
     */
    public function setValidation(CimdValidationResult $value): self
    {
        $this->validation = $value;
        $this->_setField('validation');
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
