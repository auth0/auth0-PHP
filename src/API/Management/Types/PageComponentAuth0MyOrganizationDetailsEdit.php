<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0MyOrganizationDetailsEdit extends JsonSerializableType
{
    /**
     * @var ?PageComponentAuth0MyOrganizationDetailsEditConfig $config
     */
    #[JsonProperty('config')]
    private ?PageComponentAuth0MyOrganizationDetailsEditConfig $config;

    /**
     * @param array{
     *   config?: ?PageComponentAuth0MyOrganizationDetailsEditConfig,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->config = $values['config'] ?? null;
    }

    /**
     * @return ?PageComponentAuth0MyOrganizationDetailsEditConfig
     */
    public function getConfig(): ?PageComponentAuth0MyOrganizationDetailsEditConfig
    {
        return $this->config;
    }

    /**
     * @param ?PageComponentAuth0MyOrganizationDetailsEditConfig $value
     */
    public function setConfig(?PageComponentAuth0MyOrganizationDetailsEditConfig $value = null): self
    {
        $this->config = $value;
        $this->_setField('config');
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
