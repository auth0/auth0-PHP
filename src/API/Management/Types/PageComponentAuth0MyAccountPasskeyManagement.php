<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0MyAccountPasskeyManagement extends JsonSerializableType
{
    /**
     * @var ?PageComponentAuth0MyAccountPasskeyManagementConfig $config
     */
    #[JsonProperty('config')]
    private ?PageComponentAuth0MyAccountPasskeyManagementConfig $config;

    /**
     * @param array{
     *   config?: ?PageComponentAuth0MyAccountPasskeyManagementConfig,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->config = $values['config'] ?? null;
    }

    /**
     * @return ?PageComponentAuth0MyAccountPasskeyManagementConfig
     */
    public function getConfig(): ?PageComponentAuth0MyAccountPasskeyManagementConfig
    {
        return $this->config;
    }

    /**
     * @param ?PageComponentAuth0MyAccountPasskeyManagementConfig $value
     */
    public function setConfig(?PageComponentAuth0MyAccountPasskeyManagementConfig $value = null): self
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
