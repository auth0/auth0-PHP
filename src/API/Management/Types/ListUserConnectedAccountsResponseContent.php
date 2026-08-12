<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListUserConnectedAccountsResponseContent extends JsonSerializableType
{
    /**
     * @var array<ConnectedAccount> $connectedAccounts
     */
    #[JsonProperty('connected_accounts'), ArrayType([ConnectedAccount::class])]
    private array $connectedAccounts;

    /**
     * @var ?string $next The token to retrieve the next page of connected accounts (if there is one)
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   connectedAccounts: array<ConnectedAccount>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectedAccounts = $values['connectedAccounts'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<ConnectedAccount>
     */
    public function getConnectedAccounts(): array
    {
        return $this->connectedAccounts;
    }

    /**
     * @param array<ConnectedAccount> $value
     */
    public function setConnectedAccounts(array $value): self
    {
        $this->connectedAccounts = $value;
        $this->_setField('connectedAccounts');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @param ?string $value
     */
    public function setNext(?string $value = null): self
    {
        $this->next = $value;
        $this->_setField('next');
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
