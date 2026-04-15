<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetGuardianFactorsProviderPushNotificationApnsRequestContent extends JsonSerializableType
{
    /**
     * @var ?bool $sandbox
     */
    #[JsonProperty('sandbox')]
    private ?bool $sandbox;

    /**
     * @var ?string $bundleId
     */
    #[JsonProperty('bundle_id')]
    private ?string $bundleId;

    /**
     * @var ?string $p12
     */
    #[JsonProperty('p12')]
    private ?string $p12;

    /**
     * @param array{
     *   sandbox?: ?bool,
     *   bundleId?: ?string,
     *   p12?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->sandbox = $values['sandbox'] ?? null;
        $this->bundleId = $values['bundleId'] ?? null;
        $this->p12 = $values['p12'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getSandbox(): ?bool
    {
        return $this->sandbox;
    }

    /**
     * @param ?bool $value
     */
    public function setSandbox(?bool $value = null): self
    {
        $this->sandbox = $value;
        $this->_setField('sandbox');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getBundleId(): ?string
    {
        return $this->bundleId;
    }

    /**
     * @param ?string $value
     */
    public function setBundleId(?string $value = null): self
    {
        $this->bundleId = $value;
        $this->_setField('bundleId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getP12(): ?string
    {
        return $this->p12;
    }

    /**
     * @param ?string $value
     */
    public function setP12(?string $value = null): self
    {
        $this->p12 = $value;
        $this->_setField('p12');
        return $this;
    }
}
