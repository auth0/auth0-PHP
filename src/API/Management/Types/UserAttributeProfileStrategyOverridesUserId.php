<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Strategy-specific overrides for user ID
 */
class UserAttributeProfileStrategyOverridesUserId extends JsonSerializableType
{
    /**
     * @var ?UserAttributeProfileStrategyOverridesUserIdMapping $pingfederate
     */
    #[JsonProperty('pingfederate')]
    private ?UserAttributeProfileStrategyOverridesUserIdMapping $pingfederate;

    /**
     * @var ?UserAttributeProfileStrategyOverridesUserIdMapping $ad
     */
    #[JsonProperty('ad')]
    private ?UserAttributeProfileStrategyOverridesUserIdMapping $ad;

    /**
     * @var ?UserAttributeProfileStrategyOverridesUserIdMapping $adfs
     */
    #[JsonProperty('adfs')]
    private ?UserAttributeProfileStrategyOverridesUserIdMapping $adfs;

    /**
     * @var ?UserAttributeProfileStrategyOverridesUserIdMapping $waad
     */
    #[JsonProperty('waad')]
    private ?UserAttributeProfileStrategyOverridesUserIdMapping $waad;

    /**
     * @var ?UserAttributeProfileStrategyOverridesUserIdMapping $googleApps
     */
    #[JsonProperty('google-apps')]
    private ?UserAttributeProfileStrategyOverridesUserIdMapping $googleApps;

    /**
     * @var ?UserAttributeProfileStrategyOverridesUserIdMapping $okta
     */
    #[JsonProperty('okta')]
    private ?UserAttributeProfileStrategyOverridesUserIdMapping $okta;

    /**
     * @var ?UserAttributeProfileStrategyOverridesUserIdMapping $oidc
     */
    #[JsonProperty('oidc')]
    private ?UserAttributeProfileStrategyOverridesUserIdMapping $oidc;

    /**
     * @var ?UserAttributeProfileStrategyOverridesUserIdMapping $samlp
     */
    #[JsonProperty('samlp')]
    private ?UserAttributeProfileStrategyOverridesUserIdMapping $samlp;

    /**
     * @param array{
     *   pingfederate?: ?UserAttributeProfileStrategyOverridesUserIdMapping,
     *   ad?: ?UserAttributeProfileStrategyOverridesUserIdMapping,
     *   adfs?: ?UserAttributeProfileStrategyOverridesUserIdMapping,
     *   waad?: ?UserAttributeProfileStrategyOverridesUserIdMapping,
     *   googleApps?: ?UserAttributeProfileStrategyOverridesUserIdMapping,
     *   okta?: ?UserAttributeProfileStrategyOverridesUserIdMapping,
     *   oidc?: ?UserAttributeProfileStrategyOverridesUserIdMapping,
     *   samlp?: ?UserAttributeProfileStrategyOverridesUserIdMapping,
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
     * @return ?UserAttributeProfileStrategyOverridesUserIdMapping
     */
    public function getPingfederate(): ?UserAttributeProfileStrategyOverridesUserIdMapping
    {
        return $this->pingfederate;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesUserIdMapping $value
     */
    public function setPingfederate(?UserAttributeProfileStrategyOverridesUserIdMapping $value = null): self
    {
        $this->pingfederate = $value;
        $this->_setField('pingfederate');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesUserIdMapping
     */
    public function getAd(): ?UserAttributeProfileStrategyOverridesUserIdMapping
    {
        return $this->ad;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesUserIdMapping $value
     */
    public function setAd(?UserAttributeProfileStrategyOverridesUserIdMapping $value = null): self
    {
        $this->ad = $value;
        $this->_setField('ad');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesUserIdMapping
     */
    public function getAdfs(): ?UserAttributeProfileStrategyOverridesUserIdMapping
    {
        return $this->adfs;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesUserIdMapping $value
     */
    public function setAdfs(?UserAttributeProfileStrategyOverridesUserIdMapping $value = null): self
    {
        $this->adfs = $value;
        $this->_setField('adfs');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesUserIdMapping
     */
    public function getWaad(): ?UserAttributeProfileStrategyOverridesUserIdMapping
    {
        return $this->waad;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesUserIdMapping $value
     */
    public function setWaad(?UserAttributeProfileStrategyOverridesUserIdMapping $value = null): self
    {
        $this->waad = $value;
        $this->_setField('waad');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesUserIdMapping
     */
    public function getGoogleApps(): ?UserAttributeProfileStrategyOverridesUserIdMapping
    {
        return $this->googleApps;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesUserIdMapping $value
     */
    public function setGoogleApps(?UserAttributeProfileStrategyOverridesUserIdMapping $value = null): self
    {
        $this->googleApps = $value;
        $this->_setField('googleApps');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesUserIdMapping
     */
    public function getOkta(): ?UserAttributeProfileStrategyOverridesUserIdMapping
    {
        return $this->okta;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesUserIdMapping $value
     */
    public function setOkta(?UserAttributeProfileStrategyOverridesUserIdMapping $value = null): self
    {
        $this->okta = $value;
        $this->_setField('okta');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesUserIdMapping
     */
    public function getOidc(): ?UserAttributeProfileStrategyOverridesUserIdMapping
    {
        return $this->oidc;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesUserIdMapping $value
     */
    public function setOidc(?UserAttributeProfileStrategyOverridesUserIdMapping $value = null): self
    {
        $this->oidc = $value;
        $this->_setField('oidc');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesUserIdMapping
     */
    public function getSamlp(): ?UserAttributeProfileStrategyOverridesUserIdMapping
    {
        return $this->samlp;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesUserIdMapping $value
     */
    public function setSamlp(?UserAttributeProfileStrategyOverridesUserIdMapping $value = null): self
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
