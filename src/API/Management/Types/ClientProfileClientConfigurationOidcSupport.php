<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Default OIDC support applied to matched clients.
 */
class ClientProfileClientConfigurationOidcSupport extends JsonSerializableType
{
    /**
     * @var ClientProfileClientConfigurationOidcSupportDefaultValue $defaultValue
     */
    #[JsonProperty('default_value')]
    private ClientProfileClientConfigurationOidcSupportDefaultValue $defaultValue;

    /**
     * @param array{
     *   defaultValue: ClientProfileClientConfigurationOidcSupportDefaultValue,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->defaultValue = $values['defaultValue'];
    }

    /**
     * @return ClientProfileClientConfigurationOidcSupportDefaultValue
     */
    public function getDefaultValue(): ClientProfileClientConfigurationOidcSupportDefaultValue
    {
        return $this->defaultValue;
    }

    /**
     * @param ClientProfileClientConfigurationOidcSupportDefaultValue $value
     */
    public function setDefaultValue(ClientProfileClientConfigurationOidcSupportDefaultValue $value): self
    {
        $this->defaultValue = $value;
        $this->_setField('defaultValue');
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
