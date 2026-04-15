<?php

namespace Auth0\SDK\API\Management\RefreshTokens\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateRefreshTokenRequestContent extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $refreshTokenMetadata Metadata associated with the refresh token. Pass null or {} to remove all metadata.
     */
    #[JsonProperty('refresh_token_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $refreshTokenMetadata;

    /**
     * @param array{
     *   refreshTokenMetadata?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->refreshTokenMetadata = $values['refreshTokenMetadata'] ?? null;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getRefreshTokenMetadata(): ?array
    {
        return $this->refreshTokenMetadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setRefreshTokenMetadata(?array $value = null): self
    {
        $this->refreshTokenMetadata = $value;
        $this->_setField('refreshTokenMetadata');
        return $this;
    }
}
