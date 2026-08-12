<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configure FedCM login settings for New Universal Login
 */
class FedCmLoginPatch extends JsonSerializableType
{
    /**
     * @var ?FedCmLoginGooglePatch $google
     */
    #[JsonProperty('google')]
    private ?FedCmLoginGooglePatch $google;

    /**
     * @param array{
     *   google?: ?FedCmLoginGooglePatch,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->google = $values['google'] ?? null;
    }

    /**
     * @return ?FedCmLoginGooglePatch
     */
    public function getGoogle(): ?FedCmLoginGooglePatch
    {
        return $this->google;
    }

    /**
     * @param ?FedCmLoginGooglePatch $value
     */
    public function setGoogle(?FedCmLoginGooglePatch $value = null): self
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
