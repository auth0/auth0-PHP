<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0MyOrganizationMemberManagement extends JsonSerializableType
{
    /**
     * @var ?PageComponentAuth0MyOrganizationMemberManagementConfig $config
     */
    #[JsonProperty('config')]
    private ?PageComponentAuth0MyOrganizationMemberManagementConfig $config;

    /**
     * @param array{
     *   config?: ?PageComponentAuth0MyOrganizationMemberManagementConfig,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->config = $values['config'] ?? null;
    }

    /**
     * @return ?PageComponentAuth0MyOrganizationMemberManagementConfig
     */
    public function getConfig(): ?PageComponentAuth0MyOrganizationMemberManagementConfig
    {
        return $this->config;
    }

    /**
     * @param ?PageComponentAuth0MyOrganizationMemberManagementConfig $value
     */
    public function setConfig(?PageComponentAuth0MyOrganizationMemberManagementConfig $value = null): self
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
