<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Strategy-specific overrides for this attribute
 */
class UserAttributeProfileStrategyOverrides extends JsonSerializableType
{
    /**
     * @var ?UserAttributeProfileStrategyOverridesMapping $pingfederate
     */
    #[JsonProperty('pingfederate')]
    private ?UserAttributeProfileStrategyOverridesMapping $pingfederate;

    /**
     * @var ?UserAttributeProfileStrategyOverridesMapping $ad
     */
    #[JsonProperty('ad')]
    private ?UserAttributeProfileStrategyOverridesMapping $ad;

    /**
     * @var ?UserAttributeProfileStrategyOverridesMapping $adfs
     */
    #[JsonProperty('adfs')]
    private ?UserAttributeProfileStrategyOverridesMapping $adfs;

    /**
     * @var ?UserAttributeProfileStrategyOverridesMapping $waad
     */
    #[JsonProperty('waad')]
    private ?UserAttributeProfileStrategyOverridesMapping $waad;

    /**
     * @var ?UserAttributeProfileStrategyOverridesMapping $googleApps
     */
    #[JsonProperty('google-apps')]
    private ?UserAttributeProfileStrategyOverridesMapping $googleApps;

    /**
     * @var ?UserAttributeProfileStrategyOverridesMapping $okta
     */
    #[JsonProperty('okta')]
    private ?UserAttributeProfileStrategyOverridesMapping $okta;

    /**
     * @var ?UserAttributeProfileStrategyOverridesMapping $oidc
     */
    #[JsonProperty('oidc')]
    private ?UserAttributeProfileStrategyOverridesMapping $oidc;

    /**
     * @var ?UserAttributeProfileStrategyOverridesMapping $samlp
     */
    #[JsonProperty('samlp')]
    private ?UserAttributeProfileStrategyOverridesMapping $samlp;

    /**
     * @param array{
     *   pingfederate?: ?UserAttributeProfileStrategyOverridesMapping,
     *   ad?: ?UserAttributeProfileStrategyOverridesMapping,
     *   adfs?: ?UserAttributeProfileStrategyOverridesMapping,
     *   waad?: ?UserAttributeProfileStrategyOverridesMapping,
     *   googleApps?: ?UserAttributeProfileStrategyOverridesMapping,
     *   okta?: ?UserAttributeProfileStrategyOverridesMapping,
     *   oidc?: ?UserAttributeProfileStrategyOverridesMapping,
     *   samlp?: ?UserAttributeProfileStrategyOverridesMapping,
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
     * @return ?UserAttributeProfileStrategyOverridesMapping
     */
    public function getPingfederate(): ?UserAttributeProfileStrategyOverridesMapping
    {
        return $this->pingfederate;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesMapping $value
     */
    public function setPingfederate(?UserAttributeProfileStrategyOverridesMapping $value = null): self
    {
        $this->pingfederate = $value;
        $this->_setField('pingfederate');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesMapping
     */
    public function getAd(): ?UserAttributeProfileStrategyOverridesMapping
    {
        return $this->ad;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesMapping $value
     */
    public function setAd(?UserAttributeProfileStrategyOverridesMapping $value = null): self
    {
        $this->ad = $value;
        $this->_setField('ad');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesMapping
     */
    public function getAdfs(): ?UserAttributeProfileStrategyOverridesMapping
    {
        return $this->adfs;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesMapping $value
     */
    public function setAdfs(?UserAttributeProfileStrategyOverridesMapping $value = null): self
    {
        $this->adfs = $value;
        $this->_setField('adfs');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesMapping
     */
    public function getWaad(): ?UserAttributeProfileStrategyOverridesMapping
    {
        return $this->waad;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesMapping $value
     */
    public function setWaad(?UserAttributeProfileStrategyOverridesMapping $value = null): self
    {
        $this->waad = $value;
        $this->_setField('waad');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesMapping
     */
    public function getGoogleApps(): ?UserAttributeProfileStrategyOverridesMapping
    {
        return $this->googleApps;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesMapping $value
     */
    public function setGoogleApps(?UserAttributeProfileStrategyOverridesMapping $value = null): self
    {
        $this->googleApps = $value;
        $this->_setField('googleApps');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesMapping
     */
    public function getOkta(): ?UserAttributeProfileStrategyOverridesMapping
    {
        return $this->okta;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesMapping $value
     */
    public function setOkta(?UserAttributeProfileStrategyOverridesMapping $value = null): self
    {
        $this->okta = $value;
        $this->_setField('okta');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesMapping
     */
    public function getOidc(): ?UserAttributeProfileStrategyOverridesMapping
    {
        return $this->oidc;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesMapping $value
     */
    public function setOidc(?UserAttributeProfileStrategyOverridesMapping $value = null): self
    {
        $this->oidc = $value;
        $this->_setField('oidc');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesMapping
     */
    public function getSamlp(): ?UserAttributeProfileStrategyOverridesMapping
    {
        return $this->samlp;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesMapping $value
     */
    public function setSamlp(?UserAttributeProfileStrategyOverridesMapping $value = null): self
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
