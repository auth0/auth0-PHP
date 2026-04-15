<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Strategy-specific overrides for this attribute
 */
class ConnectionProfileStrategyOverrides extends JsonSerializableType
{
    /**
     * @var ?ConnectionProfileStrategyOverride $pingfederate
     */
    #[JsonProperty('pingfederate')]
    private ?ConnectionProfileStrategyOverride $pingfederate;

    /**
     * @var ?ConnectionProfileStrategyOverride $ad
     */
    #[JsonProperty('ad')]
    private ?ConnectionProfileStrategyOverride $ad;

    /**
     * @var ?ConnectionProfileStrategyOverride $adfs
     */
    #[JsonProperty('adfs')]
    private ?ConnectionProfileStrategyOverride $adfs;

    /**
     * @var ?ConnectionProfileStrategyOverride $waad
     */
    #[JsonProperty('waad')]
    private ?ConnectionProfileStrategyOverride $waad;

    /**
     * @var ?ConnectionProfileStrategyOverride $googleApps
     */
    #[JsonProperty('google-apps')]
    private ?ConnectionProfileStrategyOverride $googleApps;

    /**
     * @var ?ConnectionProfileStrategyOverride $okta
     */
    #[JsonProperty('okta')]
    private ?ConnectionProfileStrategyOverride $okta;

    /**
     * @var ?ConnectionProfileStrategyOverride $oidc
     */
    #[JsonProperty('oidc')]
    private ?ConnectionProfileStrategyOverride $oidc;

    /**
     * @var ?ConnectionProfileStrategyOverride $samlp
     */
    #[JsonProperty('samlp')]
    private ?ConnectionProfileStrategyOverride $samlp;

    /**
     * @param array{
     *   pingfederate?: ?ConnectionProfileStrategyOverride,
     *   ad?: ?ConnectionProfileStrategyOverride,
     *   adfs?: ?ConnectionProfileStrategyOverride,
     *   waad?: ?ConnectionProfileStrategyOverride,
     *   googleApps?: ?ConnectionProfileStrategyOverride,
     *   okta?: ?ConnectionProfileStrategyOverride,
     *   oidc?: ?ConnectionProfileStrategyOverride,
     *   samlp?: ?ConnectionProfileStrategyOverride,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->pingfederate = $values['pingfederate'] ?? null;
        $this->ad = $values['ad'] ?? null;
        $this->adfs = $values['adfs'] ?? null;
        $this->waad = $values['waad'] ?? null;
        $this->googleApps = $values['googleApps'] ?? null;
        $this->okta = $values['okta'] ?? null;
        $this->oidc = $values['oidc'] ?? null;
        $this->samlp = $values['samlp'] ?? null;
    }

    /**
     * @return ?ConnectionProfileStrategyOverride
     */
    public function getPingfederate(): ?ConnectionProfileStrategyOverride
    {
        return $this->pingfederate;
    }

    /**
     * @param ?ConnectionProfileStrategyOverride $value
     */
    public function setPingfederate(?ConnectionProfileStrategyOverride $value = null): self
    {
        $this->pingfederate = $value;
        $this->_setField('pingfederate');
        return $this;
    }

    /**
     * @return ?ConnectionProfileStrategyOverride
     */
    public function getAd(): ?ConnectionProfileStrategyOverride
    {
        return $this->ad;
    }

    /**
     * @param ?ConnectionProfileStrategyOverride $value
     */
    public function setAd(?ConnectionProfileStrategyOverride $value = null): self
    {
        $this->ad = $value;
        $this->_setField('ad');
        return $this;
    }

    /**
     * @return ?ConnectionProfileStrategyOverride
     */
    public function getAdfs(): ?ConnectionProfileStrategyOverride
    {
        return $this->adfs;
    }

    /**
     * @param ?ConnectionProfileStrategyOverride $value
     */
    public function setAdfs(?ConnectionProfileStrategyOverride $value = null): self
    {
        $this->adfs = $value;
        $this->_setField('adfs');
        return $this;
    }

    /**
     * @return ?ConnectionProfileStrategyOverride
     */
    public function getWaad(): ?ConnectionProfileStrategyOverride
    {
        return $this->waad;
    }

    /**
     * @param ?ConnectionProfileStrategyOverride $value
     */
    public function setWaad(?ConnectionProfileStrategyOverride $value = null): self
    {
        $this->waad = $value;
        $this->_setField('waad');
        return $this;
    }

    /**
     * @return ?ConnectionProfileStrategyOverride
     */
    public function getGoogleApps(): ?ConnectionProfileStrategyOverride
    {
        return $this->googleApps;
    }

    /**
     * @param ?ConnectionProfileStrategyOverride $value
     */
    public function setGoogleApps(?ConnectionProfileStrategyOverride $value = null): self
    {
        $this->googleApps = $value;
        $this->_setField('googleApps');
        return $this;
    }

    /**
     * @return ?ConnectionProfileStrategyOverride
     */
    public function getOkta(): ?ConnectionProfileStrategyOverride
    {
        return $this->okta;
    }

    /**
     * @param ?ConnectionProfileStrategyOverride $value
     */
    public function setOkta(?ConnectionProfileStrategyOverride $value = null): self
    {
        $this->okta = $value;
        $this->_setField('okta');
        return $this;
    }

    /**
     * @return ?ConnectionProfileStrategyOverride
     */
    public function getOidc(): ?ConnectionProfileStrategyOverride
    {
        return $this->oidc;
    }

    /**
     * @param ?ConnectionProfileStrategyOverride $value
     */
    public function setOidc(?ConnectionProfileStrategyOverride $value = null): self
    {
        $this->oidc = $value;
        $this->_setField('oidc');
        return $this;
    }

    /**
     * @return ?ConnectionProfileStrategyOverride
     */
    public function getSamlp(): ?ConnectionProfileStrategyOverride
    {
        return $this->samlp;
    }

    /**
     * @param ?ConnectionProfileStrategyOverride $value
     */
    public function setSamlp(?ConnectionProfileStrategyOverride $value = null): self
    {
        $this->samlp = $value;
        $this->_setField('samlp');
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
