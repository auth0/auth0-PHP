<?php

namespace Auth0\SDK\API\Management\Traits;

use Auth0\SDK\API\Management\Types\ConnectionAuthenticationPurpose;
use Auth0\SDK\API\Management\Types\ConnectionConnectedAccountsPurpose;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Purposes for a connection
 *
 * @property ?ConnectionAuthenticationPurpose $authentication
 * @property ?ConnectionConnectedAccountsPurpose $connectedAccounts
 */
trait ConnectionPurposes
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
}
