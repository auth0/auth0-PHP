<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * SpringCM SSO configuration.
 */
class ClientAddonSpringCm extends JsonSerializableType
{
    /**
     * @var ?string $acsurl SpringCM ACS URL, e.g. `https://na11.springcm.com/atlas/sso/SSOEndpoint.ashx`.
     */
    #[JsonProperty('acsurl')]
    private ?string $acsurl;

    /**
     * @param array{
     *   acsurl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->acsurl = $values['acsurl'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAcsurl(): ?string
    {
        return $this->acsurl;
    }

    /**
     * @param ?string $value
     */
    public function setAcsurl(?string $value = null): self
    {
        $this->acsurl = $value;
        $this->_setField('acsurl');
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
