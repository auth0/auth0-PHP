<?php

namespace Auth0\SDK\API\Management\Users\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class RevokeUserAccessRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $sessionId ID of the session to revoke.
     */
    #[JsonProperty('session_id')]
    private ?string $sessionId;

    /**
     * @var ?bool $preserveRefreshTokens Whether to preserve the refresh tokens associated with the session.
     */
    #[JsonProperty('preserve_refresh_tokens')]
    private ?bool $preserveRefreshTokens;

    /**
     * @param array{
     *   sessionId?: ?string,
     *   preserveRefreshTokens?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->sessionId = $values['sessionId'] ?? null;
        $this->preserveRefreshTokens = $values['preserveRefreshTokens'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * @param ?string $value
     */
    public function setSessionId(?string $value = null): self
    {
        $this->sessionId = $value;
        $this->_setField('sessionId');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPreserveRefreshTokens(): ?bool
    {
        return $this->preserveRefreshTokens;
    }

    /**
     * @param ?bool $value
     */
    public function setPreserveRefreshTokens(?bool $value = null): self
    {
        $this->preserveRefreshTokens = $value;
        $this->_setField('preserveRefreshTokens');
        return $this;
    }
}
