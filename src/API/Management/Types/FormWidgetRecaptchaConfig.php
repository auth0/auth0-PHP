<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormWidgetRecaptchaConfig extends JsonSerializableType
{
    /**
     * @var string $siteKey
     */
    #[JsonProperty('site_key')]
    private string $siteKey;

    /**
     * @var string $secretKey
     */
    #[JsonProperty('secret_key')]
    private string $secretKey;

    /**
     * @param array{
     *   siteKey: string,
     *   secretKey: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->siteKey = $values['siteKey'];
        $this->secretKey = $values['secretKey'];
    }

    /**
     * @return string
     */
    public function getSiteKey(): string
    {
        return $this->siteKey;
    }

    /**
     * @param string $value
     */
    public function setSiteKey(string $value): self
    {
        $this->siteKey = $value;
        $this->_setField('siteKey');
        return $this;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @param string $value
     */
    public function setSecretKey(string $value): self
    {
        $this->secretKey = $value;
        $this->_setField('secretKey');
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
