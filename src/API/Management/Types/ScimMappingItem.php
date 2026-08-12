<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ScimMappingItem extends JsonSerializableType
{
    /**
     * @var ?string $auth0 The field location in the auth0 schema
     */
    #[JsonProperty('auth0')]
    private ?string $auth0;

    /**
     * @var ?string $scim The field location in the SCIM schema
     */
    #[JsonProperty('scim')]
    private ?string $scim;

    /**
     * @param array{
     *   auth0?: ?string,
     *   scim?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->auth0 = $values['auth0'] ?? null;
        $this->scim = $values['scim'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAuth0(): ?string
    {
        return $this->auth0;
    }

    /**
     * @param ?string $value
     */
    public function setAuth0(?string $value = null): self
    {
        $this->auth0 = $value;
        $this->_setField('auth0');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScim(): ?string
    {
        return $this->scim;
    }

    /**
     * @param ?string $value
     */
    public function setScim(?string $value = null): self
    {
        $this->scim = $value;
        $this->_setField('scim');
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
