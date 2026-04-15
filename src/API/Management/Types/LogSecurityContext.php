<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Information about security-related signals.
 */
class LogSecurityContext extends JsonSerializableType
{
    /**
     * @var ?string $ja3 JA3 fingerprint value.
     */
    #[JsonProperty('ja3')]
    private ?string $ja3;

    /**
     * @var ?string $ja4 JA4 fingerprint value.
     */
    #[JsonProperty('ja4')]
    private ?string $ja4;

    /**
     * @param array{
     *   ja3?: ?string,
     *   ja4?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ja3 = $values['ja3'] ?? null;
        $this->ja4 = $values['ja4'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getJa3(): ?string
    {
        return $this->ja3;
    }

    /**
     * @param ?string $value
     */
    public function setJa3(?string $value = null): self
    {
        $this->ja3 = $value;
        $this->_setField('ja3');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getJa4(): ?string
    {
        return $this->ja4;
    }

    /**
     * @param ?string $value
     */
    public function setJa4(?string $value = null): self
    {
        $this->ja4 = $value;
        $this->_setField('ja4');
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
