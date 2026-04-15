<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class EmailProviderCredentialsSchemaConnectionString extends JsonSerializableType
{
    /**
     * @var ?string $connectionString Azure Communication Services Connection String.
     */
    #[JsonProperty('connectionString')]
    private ?string $connectionString;

    /**
     * @param array{
     *   connectionString?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->connectionString = $values['connectionString'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getConnectionString(): ?string
    {
        return $this->connectionString;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionString(?string $value = null): self
    {
        $this->connectionString = $value;
        $this->_setField('connectionString');
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
