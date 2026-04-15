<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ClientAddonSsoIntegration extends JsonSerializableType
{
    /**
     * @var ?string $name SSO integration name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $version SSO integration version installed
     */
    #[JsonProperty('version')]
    private ?string $version;

    /**
     * @param array{
     *   name?: ?string,
     *   version?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->version = $values['version'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @param ?string $value
     */
    public function setVersion(?string $value = null): self
    {
        $this->version = $value;
        $this->_setField('version');
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
