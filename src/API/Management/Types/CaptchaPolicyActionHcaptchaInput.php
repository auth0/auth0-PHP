<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * hCaptcha provider configuration.
 */
class CaptchaPolicyActionHcaptchaInput extends JsonSerializableType
{
    /**
     * @var ?string $siteKey The hCaptcha site key.
     */
    #[JsonProperty('site_key')]
    private ?string $siteKey;

    /**
     * @var ?string $secret The hCaptcha secret key. Encrypted at rest.
     */
    #[JsonProperty('secret')]
    private ?string $secret;

    /**
     * @param array{
     *   siteKey?: ?string,
     *   secret?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->siteKey = $values['siteKey'] ?? null;
        $this->secret = $values['secret'] ?? null;
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
     * @return ?string
     */
    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * @param ?string $value
     */
    public function setSecret(?string $value = null): self
    {
        $this->secret = $value;
        $this->_setField('secret');
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
