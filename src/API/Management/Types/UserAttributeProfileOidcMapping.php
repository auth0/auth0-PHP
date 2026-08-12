<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * OIDC mapping for this attribute
 */
class UserAttributeProfileOidcMapping extends JsonSerializableType
{
    /**
     * @var string $mapping OIDC mapping field
     */
    #[JsonProperty('mapping')]
    private string $mapping;

    /**
     * @var ?string $displayName Display name for the OIDC mapping
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @param array{
     *   mapping: string,
     *   displayName?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mapping = $values['mapping'];
        $this->displayName = $values['displayName'] ?? null;
    }

    /**
     * @return string
     */
    public function getMapping(): string
    {
        return $this->mapping;
    }

    /**
     * @param string $value
     */
    public function setMapping(string $value): self
    {
        $this->mapping = $value;
        $this->_setField('mapping');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param ?string $value
     */
    public function setDisplayName(?string $value = null): self
    {
        $this->displayName = $value;
        $this->_setField('displayName');
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
