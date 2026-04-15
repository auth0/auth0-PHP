<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * New Relic SSO configuration.
 */
class ClientAddonNewRelic extends JsonSerializableType
{
    /**
     * @var ?string $account Your New Relic Account ID found in your New Relic URL after the `/accounts/` path. e.g. `https://rpm.newrelic.com/accounts/123456/query` would be `123456`.
     */
    #[JsonProperty('account')]
    private ?string $account;

    /**
     * @param array{
     *   account?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->account = $values['account'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAccount(): ?string
    {
        return $this->account;
    }

    /**
     * @param ?string $value
     */
    public function setAccount(?string $value = null): self
    {
        $this->account = $value;
        $this->_setField('account');
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
