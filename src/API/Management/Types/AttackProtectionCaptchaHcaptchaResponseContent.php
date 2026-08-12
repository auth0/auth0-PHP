<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AttackProtectionCaptchaHcaptchaResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $siteKey The site key for the hCaptcha provider.
     */
    #[JsonProperty('site_key')]
    private ?string $siteKey;

    /**
     * @param array{
     *   siteKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->siteKey = $values['siteKey'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getSiteKey(): ?string
    {
        return $this->siteKey;
    }

    /**
     * @param ?string $value
     */
    public function setSiteKey(?string $value = null): self
    {
        $this->siteKey = $value;
        $this->_setField('siteKey');
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
