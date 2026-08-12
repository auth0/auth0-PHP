<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetGuardianFactorsProviderApnsResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $bundleId
     */
    #[JsonProperty('bundle_id')]
    private ?string $bundleId;

    /**
     * @var ?bool $sandbox
     */
    #[JsonProperty('sandbox')]
    private ?bool $sandbox;

    /**
     * @var ?bool $enabled
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @param array{
     *   bundleId?: ?string,
     *   sandbox?: ?bool,
     *   enabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->bundleId = $values['bundleId'] ?? null;
        $this->sandbox = $values['sandbox'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
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
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
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
