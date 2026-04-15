<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class DirectoryProvisioningMappingItem extends JsonSerializableType
{
    /**
     * @var string $auth0 The field location in the Auth0 schema
     */
    #[JsonProperty('auth0')]
    private string $auth0;

    /**
     * @var string $idp The field location in the IDP schema
     */
    #[JsonProperty('idp')]
    private string $idp;

    /**
     * @param array{
     *   auth0: string,
     *   idp: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->auth0 = $values['auth0'];
        $this->idp = $values['idp'];
    }

    /**
     * @return string
     */
    public function getAuth0(): string
    {
        return $this->auth0;
    }

    /**
     * @param string $value
     */
    public function setAuth0(string $value): self
    {
        $this->auth0 = $value;
        $this->_setField('auth0');
        return $this;
    }

    /**
     * @return string
     */
    public function getIdp(): string
    {
        return $this->idp;
    }

    /**
     * @param string $value
     */
    public function setIdp(string $value): self
    {
        $this->idp = $value;
        $this->_setField('idp');
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
