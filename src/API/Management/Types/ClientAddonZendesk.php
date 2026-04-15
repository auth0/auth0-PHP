<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Zendesk SSO configuration.
 */
class ClientAddonZendesk extends JsonSerializableType
{
    /**
     * @var ?string $accountName Zendesk account name usually first segment in your Zendesk URL. e.g. `https://acme-org.zendesk.com` would be `acme-org`.
     */
    #[JsonProperty('accountName')]
    private ?string $accountName;

    /**
     * @param array{
     *   accountName?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accountName = $values['accountName'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    /**
     * @param ?string $value
     */
    public function setAccountName(?string $value = null): self
    {
        $this->accountName = $value;
        $this->_setField('accountName');
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
