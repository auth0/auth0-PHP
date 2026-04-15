<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Additional configuration for native mobile apps.
 */
class ClientMobile extends JsonSerializableType
{
    /**
     * @var ?ClientMobileAndroid $android
     */
    #[JsonProperty('android')]
    private ?ClientMobileAndroid $android;

    /**
     * @var ?ClientMobileiOs $ios
     */
    #[JsonProperty('ios')]
    private ?ClientMobileiOs $ios;

    /**
     * @param array{
     *   android?: ?ClientMobileAndroid,
     *   ios?: ?ClientMobileiOs,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->android = $values['android'] ?? null;
        $this->ios = $values['ios'] ?? null;
    }

    /**
     * @return ?ClientMobileAndroid
     */
    public function getAndroid(): ?ClientMobileAndroid
    {
        return $this->android;
    }

    /**
     * @param ?ClientMobileAndroid $value
     */
    public function setAndroid(?ClientMobileAndroid $value = null): self
    {
        $this->android = $value;
        $this->_setField('android');
        return $this;
    }

    /**
     * @return ?ClientMobileiOs
     */
    public function getIos(): ?ClientMobileiOs
    {
        return $this->ios;
    }

    /**
     * @param ?ClientMobileiOs $value
     */
    public function setIos(?ClientMobileiOs $value = null): self
    {
        $this->ios = $value;
        $this->_setField('ios');
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
