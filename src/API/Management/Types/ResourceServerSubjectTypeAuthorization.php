<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Defines application access permission for a resource server
 */
class ResourceServerSubjectTypeAuthorization extends JsonSerializableType
{
    /**
     * @var ?ResourceServerSubjectTypeAuthorizationUser $user
     */
    #[JsonProperty('user')]
    private ?ResourceServerSubjectTypeAuthorizationUser $user;

    /**
     * @var ?ResourceServerSubjectTypeAuthorizationClient $client
     */
    #[JsonProperty('client')]
    private ?ResourceServerSubjectTypeAuthorizationClient $client;

    /**
     * @param array{
     *   user?: ?ResourceServerSubjectTypeAuthorizationUser,
     *   client?: ?ResourceServerSubjectTypeAuthorizationClient,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->user = $values['user'] ?? null;
        $this->client = $values['client'] ?? null;
    }

    /**
     * @return ?ResourceServerSubjectTypeAuthorizationUser
     */
    public function getUser(): ?ResourceServerSubjectTypeAuthorizationUser
    {
        return $this->user;
    }

    /**
     * @param ?ResourceServerSubjectTypeAuthorizationUser $value
     */
    public function setUser(?ResourceServerSubjectTypeAuthorizationUser $value = null): self
    {
        $this->user = $value;
        $this->_setField('user');
        return $this;
    }

    /**
     * @return ?ResourceServerSubjectTypeAuthorizationClient
     */
    public function getClient(): ?ResourceServerSubjectTypeAuthorizationClient
    {
        return $this->client;
    }

    /**
     * @param ?ResourceServerSubjectTypeAuthorizationClient $value
     */
    public function setClient(?ResourceServerSubjectTypeAuthorizationClient $value = null): self
    {
        $this->client = $value;
        $this->_setField('client');
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
