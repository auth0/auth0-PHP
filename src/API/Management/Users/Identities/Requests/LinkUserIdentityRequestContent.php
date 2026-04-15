<?php

namespace Auth0\SDK\API\Management\Users\Identities\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\UserIdentityProviderEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class LinkUserIdentityRequestContent extends JsonSerializableType
{
    /**
     * @var ?value-of<UserIdentityProviderEnum> $provider Identity provider of the secondary user account being linked.
     */
    #[JsonProperty('provider')]
    private ?string $provider;

    /**
     * @var ?string $connectionId connection_id of the secondary user account being linked when more than one `auth0` database provider exists.
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @var (
     *    string
     *   |int
     * )|null $userId
     */
    #[JsonProperty('user_id'), Union('string', 'integer', 'null')]
    private string|int|null $userId;

    /**
     * @var ?string $linkWith JWT for the secondary account being linked. If sending this parameter, `provider`, `user_id`, and `connection_id` must not be sent.
     */
    #[JsonProperty('link_with')]
    private ?string $linkWith;

    /**
     * @param array{
     *   provider?: ?value-of<UserIdentityProviderEnum>,
     *   connectionId?: ?string,
     *   userId?: (
     *    string
     *   |int
     * )|null,
     *   linkWith?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->provider = $values['provider'] ?? null;
        $this->connectionId = $values['connectionId'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->linkWith = $values['linkWith'] ?? null;
    }

    /**
     * @return ?value-of<UserIdentityProviderEnum>
     */
    public function getProvider(): ?string
    {
        return $this->provider;
    }

    /**
     * @param ?value-of<UserIdentityProviderEnum> $value
     */
    public function setProvider(?string $value = null): self
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
     * @return (
     *    string
     *   |int
     * )|null
     */
    public function getUserId(): string|int|null
    {
        return $this->userId;
    }

    /**
     * @param (
     *    string
     *   |int
     * )|null $value
     */
    public function setUserId(string|int|null $value = null): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLinkWith(): ?string
    {
        return $this->linkWith;
    }

    /**
     * @param ?string $value
     */
    public function setLinkWith(?string $value = null): self
    {
        $this->linkWith = $value;
        $this->_setField('linkWith');
        return $this;
    }
}
