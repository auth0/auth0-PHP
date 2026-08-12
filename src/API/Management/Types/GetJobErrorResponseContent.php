<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetJobErrorResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $user
     */
    #[JsonProperty('user'), ArrayType(['string' => 'mixed'])]
    private ?array $user;

    /**
     * @var ?array<GetJobImportUserError> $errors Errors importing the user.
     */
    #[JsonProperty('errors'), ArrayType([GetJobImportUserError::class])]
    private ?array $errors;

    /**
     * @param array{
     *   user?: ?array<string, mixed>,
     *   errors?: ?array<GetJobImportUserError>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->user = $values['user'] ?? null;
        $this->errors = $values['errors'] ?? null;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getUser(): ?array
    {
        return $this->user;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setUser(?array $value = null): self
    {
        $this->user = $value;
        $this->_setField('user');
        return $this;
    }

    /**
     * @return ?array<GetJobImportUserError>
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @param ?array<GetJobImportUserError> $value
     */
    public function setErrors(?array $value = null): self
    {
        $this->errors = $value;
        $this->_setField('errors');
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
