<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for Third Party Client Access during the Self-Service Enterprise Configuration flow.
 */
class ThirdPartyClientAccessConfig extends JsonSerializableType
{
    /**
     * @var bool $allowConfiguration Whether third-party applications can configure the connection as a domain-level connection during the Self-Service Enterprise Configuration flow.
     */
    #[JsonProperty('allow_configuration')]
    private bool $allowConfiguration;

    /**
     * @param array{
     *   allowConfiguration: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->allowConfiguration = $values['allowConfiguration'];
    }

    /**
     * @return bool
     */
    public function getAllowConfiguration(): bool
    {
        return $this->allowConfiguration;
    }

    /**
     * @param bool $value
     */
    public function setAllowConfiguration(bool $value): self
    {
        $this->allowConfiguration = $value;
        $this->_setField('allowConfiguration');
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
