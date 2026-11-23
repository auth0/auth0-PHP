<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Dictionary-based password restriction policy to prevent common passwords
 */
class ConnectionPasswordOptionsDictionary extends JsonSerializableType
{
    /**
     * @var ?bool $active Enables dictionary checking to prevent use of common passwords and custom blocked words
     */
    #[JsonProperty('active')]
    private ?bool $active;

    /**
     * @var ?array<string> $custom Array of custom words to block in passwords
     */
    #[JsonProperty('custom'), ArrayType(['string'])]
    private ?array $custom;

    /**
     * @var ?value-of<PasswordDictionaryMatchTypeEnum> $matchType
     */
    #[JsonProperty('match_type')]
    private ?string $matchType;

    /**
     * @var ?value-of<PasswordDefaultDictionariesEnum> $default
     */
    #[JsonProperty('default')]
    private ?string $default;

    /**
     * @param array{
     *   active?: ?bool,
     *   custom?: ?array<string>,
     *   matchType?: ?value-of<PasswordDictionaryMatchTypeEnum>,
     *   default?: ?value-of<PasswordDefaultDictionariesEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->active = $values['active'] ?? null;
        $this->custom = $values['custom'] ?? null;
        $this->matchType = $values['matchType'] ?? null;
        $this->default = $values['default'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param ?bool $value
     */
    public function setActive(?bool $value = null): self
    {
        $this->active = $value;
        $this->_setField('active');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getCustom(): ?array
    {
        return $this->custom;
    }

    /**
     * @param ?array<string> $value
     */
    public function setCustom(?array $value = null): self
    {
        $this->custom = $value;
        $this->_setField('custom');
        return $this;
    }

    /**
     * @return ?value-of<PasswordDictionaryMatchTypeEnum>
     */
    public function getMatchType(): ?string
    {
        return $this->matchType;
    }

    /**
     * @param ?value-of<PasswordDictionaryMatchTypeEnum> $value
     */
    public function setMatchType(?string $value = null): self
    {
        $this->matchType = $value;
        $this->_setField('matchType');
        return $this;
    }

    /**
     * @return ?value-of<PasswordDefaultDictionariesEnum>
     */
    public function getDefault(): ?string
    {
        return $this->default;
    }

    /**
     * @param ?value-of<PasswordDefaultDictionariesEnum> $value
     */
    public function setDefault(?string $value = null): self
    {
        $this->default = $value;
        $this->_setField('default');
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
