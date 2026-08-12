<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListDirectoryProvisioningsResponseContent extends JsonSerializableType
{
    /**
     * @var array<DirectoryProvisioning> $directoryProvisionings List of directory provisioning configurations
     */
    #[JsonProperty('directory_provisionings'), ArrayType([DirectoryProvisioning::class])]
    private array $directoryProvisionings;

    /**
     * @var ?string $next The cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   directoryProvisionings: array<DirectoryProvisioning>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->directoryProvisionings = $values['directoryProvisionings'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<DirectoryProvisioning>
     */
    public function getDirectoryProvisionings(): array
    {
        return $this->directoryProvisionings;
    }

    /**
     * @param array<DirectoryProvisioning> $value
     */
    public function setDirectoryProvisionings(array $value): self
    {
        $this->directoryProvisionings = $value;
        $this->_setField('directoryProvisionings');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @param ?string $value
     */
    public function setNext(?string $value = null): self
    {
        $this->next = $value;
        $this->_setField('next');
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
