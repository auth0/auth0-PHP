<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AttackProtectionCaptchaArkoseResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $siteKey The site key for the Arkose captcha provider.
     */
    #[JsonProperty('site_key')]
    private ?string $siteKey;

    /**
     * @var ?bool $failOpen Whether the captcha should fail open.
     */
    #[JsonProperty('fail_open')]
    private ?bool $failOpen;

    /**
     * @var ?string $clientSubdomain The subdomain used for client requests to the Arkose captcha provider.
     */
    #[JsonProperty('client_subdomain')]
    private ?string $clientSubdomain;

    /**
     * @var ?string $verifySubdomain The subdomain used for server-side verification requests to the Arkose captcha provider.
     */
    #[JsonProperty('verify_subdomain')]
    private ?string $verifySubdomain;

    /**
     * @param array{
     *   siteKey?: ?string,
     *   failOpen?: ?bool,
     *   clientSubdomain?: ?string,
     *   verifySubdomain?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->siteKey = $values['siteKey'] ?? null;
        $this->failOpen = $values['failOpen'] ?? null;
        $this->clientSubdomain = $values['clientSubdomain'] ?? null;
        $this->verifySubdomain = $values['verifySubdomain'] ?? null;
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
     * @return ?bool
     */
    public function getFailOpen(): ?bool
    {
        return $this->failOpen;
    }

    /**
     * @param ?bool $value
     */
    public function setFailOpen(?bool $value = null): self
    {
        $this->failOpen = $value;
        $this->_setField('failOpen');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientSubdomain(): ?string
    {
        return $this->clientSubdomain;
    }

    /**
     * @param ?string $value
     */
    public function setClientSubdomain(?string $value = null): self
    {
        $this->clientSubdomain = $value;
        $this->_setField('clientSubdomain');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getVerifySubdomain(): ?string
    {
        return $this->verifySubdomain;
    }

    /**
     * @param ?string $value
     */
    public function setVerifySubdomain(?string $value = null): self
    {
        $this->verifySubdomain = $value;
        $this->_setField('verifySubdomain');
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
