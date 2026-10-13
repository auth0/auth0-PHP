<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Arkose Labs provider configuration.
 */
class CaptchaPolicyActionArkoseInput extends JsonSerializableType
{
    /**
     * @var ?string $siteKey The Arkose Labs site key.
     */
    #[JsonProperty('site_key')]
    private ?string $siteKey;

    /**
     * @var ?string $secret The Arkose Labs private key. Encrypted at rest.
     */
    #[JsonProperty('secret')]
    private ?string $secret;

    /**
     * @var ?string $clientSubdomain The Arkose Labs client subdomain.
     */
    #[JsonProperty('client_subdomain')]
    private ?string $clientSubdomain;

    /**
     * @var ?string $verifySubdomain The Arkose Labs verify subdomain.
     */
    #[JsonProperty('verify_subdomain')]
    private ?string $verifySubdomain;

    /**
     * @var ?bool $failOpen Whether to allow access when Arkose Labs is unavailable.
     */
    #[JsonProperty('fail_open')]
    private ?bool $failOpen;

    /**
     * @param array{
     *   siteKey?: ?string,
     *   secret?: ?string,
     *   clientSubdomain?: ?string,
     *   verifySubdomain?: ?string,
     *   failOpen?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->siteKey = $values['siteKey'] ?? null;
        $this->secret = $values['secret'] ?? null;
        $this->clientSubdomain = $values['clientSubdomain'] ?? null;
        $this->verifySubdomain = $values['verifySubdomain'] ?? null;
        $this->failOpen = $values['failOpen'] ?? null;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
