<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Dependency is an npm module. These values are used to produce an immutable artifact, which manifests as a layer_id.
 */
class ActionVersionDependency extends JsonSerializableType
{
    /**
     * @var ?string $name name is the name of the npm module, e.g. lodash
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $version description is the version of the npm module, e.g. 4.17.1
     */
    #[JsonProperty('version')]
    private ?string $version;

    /**
     * @var ?string $registryUrl registry_url is an optional value used primarily for private npm registries.
     */
    #[JsonProperty('registry_url')]
    private ?string $registryUrl;

    /**
     * @param array{
     *   name?: ?string,
     *   version?: ?string,
     *   registryUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->version = $values['version'] ?? null;
        $this->registryUrl = $values['registryUrl'] ?? null;
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
     * @return ?string
     */
    public function getRegistryUrl(): ?string
    {
        return $this->registryUrl;
    }

    /**
     * @param ?string $value
     */
    public function setRegistryUrl(?string $value = null): self
    {
        $this->registryUrl = $value;
        $this->_setField('registryUrl');
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
