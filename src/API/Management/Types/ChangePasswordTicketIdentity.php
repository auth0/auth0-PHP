<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The user's identity. If you set this value, you must also send the user_id parameter.
 */
class ChangePasswordTicketIdentity extends JsonSerializableType
{
    /**
     * @var string $userId user_id of the identity.
     */
    #[JsonProperty('user_id')]
    private string $userId;

    /**
     * @var value-of<IdentityProviderOnlyAuth0Enum> $provider
     */
    #[JsonProperty('provider')]
    private string $provider;

    /**
     * @var ?string $connectionId connection_id of the identity.
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @param array{
     *   userId: string,
     *   provider: value-of<IdentityProviderOnlyAuth0Enum>,
     *   connectionId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->provider = $values['provider'];
        $this->connectionId = $values['connectionId'] ?? null;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $value
     */
    public function setUserId(string $value): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return value-of<IdentityProviderOnlyAuth0Enum>
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param value-of<IdentityProviderOnlyAuth0Enum> $value
     */
    public function setProvider(string $value): self
    {
        $this->provider = $value;
        $this->_setField('provider');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
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
