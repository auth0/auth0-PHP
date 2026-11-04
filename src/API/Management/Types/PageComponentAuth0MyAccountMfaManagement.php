<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0MyAccountMfaManagement extends JsonSerializableType
{
    /**
     * @var ?PageComponentAuth0MyAccountMfaManagementConfig $config
     */
    #[JsonProperty('config')]
    private ?PageComponentAuth0MyAccountMfaManagementConfig $config;

    /**
     * @param array{
     *   config?: ?PageComponentAuth0MyAccountMfaManagementConfig,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->config = $values['config'] ?? null;
    }

    /**
     * @return ?PageComponentAuth0MyAccountMfaManagementConfig
     */
    public function getConfig(): ?PageComponentAuth0MyAccountMfaManagementConfig
    {
        return $this->config;
    }

    /**
     * @param ?PageComponentAuth0MyAccountMfaManagementConfig $value
     */
    public function setConfig(?PageComponentAuth0MyAccountMfaManagementConfig $value = null): self
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
