<?php

namespace Auth0\SDK\API\Management\Sessions\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateSessionRequestContent extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $sessionMetadata Metadata associated with the session. Pass null or {} to remove all session_metadata.
     */
    #[JsonProperty('session_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $sessionMetadata;

    /**
     * @param array{
     *   sessionMetadata?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->sessionMetadata = $values['sessionMetadata'] ?? null;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getSessionMetadata(): ?array
    {
        return $this->sessionMetadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setSessionMetadata(?array $value = null): self
    {
        $this->sessionMetadata = $value;
        $this->_setField('sessionMetadata');
        return $this;
    }
}
