<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configure native social settings
 */
class NativeSocialLoginPatch extends JsonSerializableType
{
    /**
     * @var ?NativeSocialLoginApplePatch $apple
     */
    #[JsonProperty('apple')]
    private ?NativeSocialLoginApplePatch $apple;

    /**
     * @var ?NativeSocialLoginFacebookPatch $facebook
     */
    #[JsonProperty('facebook')]
    private ?NativeSocialLoginFacebookPatch $facebook;

    /**
     * @var ?NativeSocialLoginGooglePatch $google
     */
    #[JsonProperty('google')]
    private ?NativeSocialLoginGooglePatch $google;

    /**
     * @param array{
     *   apple?: ?NativeSocialLoginApplePatch,
     *   facebook?: ?NativeSocialLoginFacebookPatch,
     *   google?: ?NativeSocialLoginGooglePatch,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->apple = $values['apple'] ?? null;
        $this->facebook = $values['facebook'] ?? null;
        $this->google = $values['google'] ?? null;
    }

    /**
     * @return ?NativeSocialLoginApplePatch
     */
    public function getApple(): ?NativeSocialLoginApplePatch
    {
        return $this->apple;
    }

    /**
     * @param ?NativeSocialLoginApplePatch $value
     */
    public function setApple(?NativeSocialLoginApplePatch $value = null): self
    {
        $this->apple = $value;
        $this->_setField('apple');
        return $this;
    }

    /**
     * @return ?NativeSocialLoginFacebookPatch
     */
    public function getFacebook(): ?NativeSocialLoginFacebookPatch
    {
        return $this->facebook;
    }

    /**
     * @param ?NativeSocialLoginFacebookPatch $value
     */
    public function setFacebook(?NativeSocialLoginFacebookPatch $value = null): self
    {
        $this->facebook = $value;
        $this->_setField('facebook');
        return $this;
    }

    /**
     * @return ?NativeSocialLoginGooglePatch
     */
    public function getGoogle(): ?NativeSocialLoginGooglePatch
    {
        return $this->google;
    }

    /**
     * @param ?NativeSocialLoginGooglePatch $value
     */
    public function setGoogle(?NativeSocialLoginGooglePatch $value = null): self
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
