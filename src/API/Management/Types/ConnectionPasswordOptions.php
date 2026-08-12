<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Password policy options for flexible password policy configuration
 */
class ConnectionPasswordOptions extends JsonSerializableType
{
    /**
     * @var ?ConnectionPasswordOptionsComplexity $complexity
     */
    #[JsonProperty('complexity')]
    private ?ConnectionPasswordOptionsComplexity $complexity;

    /**
     * @var ?ConnectionPasswordOptionsDictionary $dictionary
     */
    #[JsonProperty('dictionary')]
    private ?ConnectionPasswordOptionsDictionary $dictionary;

    /**
     * @var ?ConnectionPasswordOptionsHistory $history
     */
    #[JsonProperty('history')]
    private ?ConnectionPasswordOptionsHistory $history;

    /**
     * @var ?ConnectionPasswordOptionsProfileData $profileData
     */
    #[JsonProperty('profile_data')]
    private ?ConnectionPasswordOptionsProfileData $profileData;

    /**
     * @param array{
     *   complexity?: ?ConnectionPasswordOptionsComplexity,
     *   dictionary?: ?ConnectionPasswordOptionsDictionary,
     *   history?: ?ConnectionPasswordOptionsHistory,
     *   profileData?: ?ConnectionPasswordOptionsProfileData,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->complexity = $values['complexity'] ?? null;
        $this->dictionary = $values['dictionary'] ?? null;
        $this->history = $values['history'] ?? null;
        $this->profileData = $values['profileData'] ?? null;
    }

    /**
     * @return ?ConnectionPasswordOptionsComplexity
     */
    public function getComplexity(): ?ConnectionPasswordOptionsComplexity
    {
        return $this->complexity;
    }

    /**
     * @param ?ConnectionPasswordOptionsComplexity $value
     */
    public function setComplexity(?ConnectionPasswordOptionsComplexity $value = null): self
    {
        $this->complexity = $value;
        $this->_setField('complexity');
        return $this;
    }

    /**
     * @return ?ConnectionPasswordOptionsDictionary
     */
    public function getDictionary(): ?ConnectionPasswordOptionsDictionary
    {
        return $this->dictionary;
    }

    /**
     * @param ?ConnectionPasswordOptionsDictionary $value
     */
    public function setDictionary(?ConnectionPasswordOptionsDictionary $value = null): self
    {
        $this->dictionary = $value;
        $this->_setField('dictionary');
        return $this;
    }

    /**
     * @return ?ConnectionPasswordOptionsHistory
     */
    public function getHistory(): ?ConnectionPasswordOptionsHistory
    {
        return $this->history;
    }

    /**
     * @param ?ConnectionPasswordOptionsHistory $value
     */
    public function setHistory(?ConnectionPasswordOptionsHistory $value = null): self
    {
        $this->history = $value;
        $this->_setField('history');
        return $this;
    }

    /**
     * @return ?ConnectionPasswordOptionsProfileData
     */
    public function getProfileData(): ?ConnectionPasswordOptionsProfileData
    {
        return $this->profileData;
    }

    /**
     * @param ?ConnectionPasswordOptionsProfileData $value
     */
    public function setProfileData(?ConnectionPasswordOptionsProfileData $value = null): self
    {
        $this->profileData = $value;
        $this->_setField('profileData');
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
