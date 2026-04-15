<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetGuardianFactorsProviderPushNotificationApnsResponseContent extends JsonSerializableType
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
     * @param array{
     *   sandbox?: ?bool,
     *   bundleId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->sandbox = $values['sandbox'] ?? null;
        $this->bundleId = $values['bundleId'] ?? null;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
