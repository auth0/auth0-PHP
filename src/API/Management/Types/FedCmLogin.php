<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configure FedCM login settings for New Universal Login
 */
class FedCmLogin extends JsonSerializableType
{
    /**
     * @var ?FedCmLoginGoogle $google
     */
    #[JsonProperty('google')]
    private ?FedCmLoginGoogle $google;

    /**
     * @param array{
     *   google?: ?FedCmLoginGoogle,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->google = $values['google'] ?? null;
    }

    /**
     * @return ?FedCmLoginGoogle
     */
    public function getGoogle(): ?FedCmLoginGoogle
    {
        return $this->google;
    }

    /**
     * @param ?FedCmLoginGoogle $value
     */
    public function setGoogle(?FedCmLoginGoogle $value = null): self
    {
        $this->google = $value;
        $this->_setField('google');
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
