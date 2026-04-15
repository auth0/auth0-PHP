<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class PreviewCimdMetadataResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $clientId The client_id of an existing client registered with this external_client_id, if one exists.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?array<string> $errors Array of retrieval errors (populated when the metadata document could not be fetched). When present, validation is omitted.
     */
    #[JsonProperty('errors'), ArrayType(['string'])]
    private ?array $errors;

    /**
     * @var ?CimdValidationResult $validation
     */
    #[JsonProperty('validation')]
    private ?CimdValidationResult $validation;

    /**
     * @var ?CimdMappedClientFields $mappedFields
     */
    #[JsonProperty('mapped_fields')]
    private ?CimdMappedClientFields $mappedFields;

    /**
     * @param array{
     *   clientId?: ?string,
     *   errors?: ?array<string>,
     *   validation?: ?CimdValidationResult,
     *   mappedFields?: ?CimdMappedClientFields,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clientId = $values['clientId'] ?? null;
        $this->errors = $values['errors'] ?? null;
        $this->validation = $values['validation'] ?? null;
        $this->mappedFields = $values['mappedFields'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @param ?array<string> $value
     */
    public function setErrors(?array $value = null): self
    {
        $this->errors = $value;
        $this->_setField('errors');
        return $this;
    }

    /**
     * @return ?CimdValidationResult
     */
    public function getValidation(): ?CimdValidationResult
    {
        return $this->validation;
    }

    /**
     * @param ?CimdValidationResult $value
     */
    public function setValidation(?CimdValidationResult $value = null): self
    {
        $this->validation = $value;
        $this->_setField('validation');
        return $this;
    }

    /**
     * @return ?CimdMappedClientFields
     */
    public function getMappedFields(): ?CimdMappedClientFields
    {
        return $this->mappedFields;
    }

    /**
     * @param ?CimdMappedClientFields $value
     */
    public function setMappedFields(?CimdMappedClientFields $value = null): self
    {
        $this->mappedFields = $value;
        $this->_setField('mappedFields');
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
