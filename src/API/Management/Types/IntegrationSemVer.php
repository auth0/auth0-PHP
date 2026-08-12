<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Semver denotes the major.minor version of an integration release
 */
class IntegrationSemVer extends JsonSerializableType
{
    /**
     * @var ?int $major Major is the major number of a semver
     */
    #[JsonProperty('major')]
    private ?int $major;

    /**
     * @var ?int $minor Minior is the minior number of a semver
     */
    #[JsonProperty('minor')]
    private ?int $minor;

    /**
     * @param array{
     *   major?: ?int,
     *   minor?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->major = $values['major'] ?? null;
        $this->minor = $values['minor'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getMajor(): ?int
    {
        return $this->major;
    }

    /**
     * @param ?int $value
     */
    public function setMajor(?int $value = null): self
    {
        $this->major = $value;
        $this->_setField('major');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getMinor(): ?int
    {
        return $this->minor;
    }

    /**
     * @param ?int $value
     */
    public function setMinor(?int $value = null): self
    {
        $this->minor = $value;
        $this->_setField('minor');
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
