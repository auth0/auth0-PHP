<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configure native social settings
 */
class NativeSocialLogin extends JsonSerializableType
{
    /**
     * @var ?NativeSocialLoginApple $apple
     */
    #[JsonProperty('apple')]
    private ?NativeSocialLoginApple $apple;

    /**
     * @var ?NativeSocialLoginFacebook $facebook
     */
    #[JsonProperty('facebook')]
    private ?NativeSocialLoginFacebook $facebook;

    /**
     * @var ?NativeSocialLoginGoogle $google
     */
    #[JsonProperty('google')]
    private ?NativeSocialLoginGoogle $google;

    /**
     * @param array{
     *   apple?: ?NativeSocialLoginApple,
     *   facebook?: ?NativeSocialLoginFacebook,
     *   google?: ?NativeSocialLoginGoogle,
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
     * @return ?NativeSocialLoginApple
     */
    public function getApple(): ?NativeSocialLoginApple
    {
        return $this->apple;
    }

    /**
     * @param ?NativeSocialLoginApple $value
     */
    public function setApple(?NativeSocialLoginApple $value = null): self
    {
        $this->apple = $value;
        $this->_setField('apple');
        return $this;
    }

    /**
     * @return ?NativeSocialLoginFacebook
     */
    public function getFacebook(): ?NativeSocialLoginFacebook
    {
        return $this->facebook;
    }

    /**
     * @param ?NativeSocialLoginFacebook $value
     */
    public function setFacebook(?NativeSocialLoginFacebook $value = null): self
    {
        $this->facebook = $value;
        $this->_setField('facebook');
        return $this;
    }

    /**
     * @return ?NativeSocialLoginGoogle
     */
    public function getGoogle(): ?NativeSocialLoginGoogle
    {
        return $this->google;
    }

    /**
     * @param ?NativeSocialLoginGoogle $value
     */
    public function setGoogle(?NativeSocialLoginGoogle $value = null): self
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
