<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Purposes for a connection
 */
class ConnectionPurposes extends JsonSerializableType
{
    /**
     * @var ?ConnectionAuthenticationPurpose $authentication
     */
    #[JsonProperty('authentication')]
    private ?ConnectionAuthenticationPurpose $authentication;

    /**
     * @var ?ConnectionConnectedAccountsPurpose $connectedAccounts
     */
    #[JsonProperty('connected_accounts')]
    private ?ConnectionConnectedAccountsPurpose $connectedAccounts;

    /**
     * @param array{
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurpose,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->authentication = $values['authentication'] ?? null;
        $this->connectedAccounts = $values['connectedAccounts'] ?? null;
    }

    /**
     * @return ?ConnectionAuthenticationPurpose
     */
    public function getAuthentication(): ?ConnectionAuthenticationPurpose
    {
        return $this->authentication;
    }

    /**
     * @param ?ConnectionAuthenticationPurpose $value
     */
    public function setAuthentication(?ConnectionAuthenticationPurpose $value = null): self
    {
        $this->authentication = $value;
        $this->_setField('authentication');
        return $this;
    }

    /**
     * @return ?ConnectionConnectedAccountsPurpose
     */
    public function getConnectedAccounts(): ?ConnectionConnectedAccountsPurpose
    {
        return $this->connectedAccounts;
    }

    /**
     * @param ?ConnectionConnectedAccountsPurpose $value
     */
    public function setConnectedAccounts(?ConnectionConnectedAccountsPurpose $value = null): self
    {
        $this->connectedAccounts = $value;
        $this->_setField('connectedAccounts');
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
