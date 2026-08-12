<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Options for password dictionary policy
 */
class ConnectionPasswordDictionaryOptions extends JsonSerializableType
{
    /**
     * @var bool $enable
     */
    #[JsonProperty('enable')]
    private bool $enable;

    /**
     * @var ?array<string> $dictionary Custom Password Dictionary. An array of up to 200 entries.
     */
    #[JsonProperty('dictionary'), ArrayType(['string'])]
    private ?array $dictionary;

    /**
     * @param array{
     *   enable: bool,
     *   dictionary?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->enable = $values['enable'];
        $this->dictionary = $values['dictionary'] ?? null;
    }

    /**
     * @return bool
     */
    public function getEnable(): bool
    {
        return $this->enable;
    }

    /**
     * @param bool $value
     */
    public function setEnable(bool $value): self
    {
        $this->enable = $value;
        $this->_setField('enable');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getDictionary(): ?array
    {
        return $this->dictionary;
    }

    /**
     * @param ?array<string> $value
     */
    public function setDictionary(?array $value = null): self
    {
        $this->dictionary = $value;
        $this->_setField('dictionary');
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
