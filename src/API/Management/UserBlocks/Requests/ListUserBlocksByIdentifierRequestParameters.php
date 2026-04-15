<?php

namespace Auth0\SDK\API\Management\UserBlocks\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListUserBlocksByIdentifierRequestParameters extends JsonSerializableType
{
    /**
     * @var string $identifier Should be any of a username, phone number, or email.
     */
    private string $identifier;

    /**
     *
     *           If true and Brute Force Protection is enabled and configured to block logins, will return a list of blocked IP addresses.
     *           If true and Brute Force Protection is disabled, will return an empty list.
     *
     *
     * @var ?bool $considerBruteForceEnablement
     */
    private ?bool $considerBruteForceEnablement;

    /**
     * @param array{
     *   identifier: string,
     *   considerBruteForceEnablement?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->identifier = $values['identifier'];
        $this->considerBruteForceEnablement = $values['considerBruteForceEnablement'] ?? null;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $value
     */
    public function setIdentifier(string $value): self
    {
        $this->identifier = $value;
        $this->_setField('identifier');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getConsiderBruteForceEnablement(): ?bool
    {
        return $this->considerBruteForceEnablement;
    }

    /**
     * @param ?bool $value
     */
    public function setConsiderBruteForceEnablement(?bool $value = null): self
    {
        $this->considerBruteForceEnablement = $value;
        $this->_setField('considerBruteForceEnablement');
        return $this;
    }
}
