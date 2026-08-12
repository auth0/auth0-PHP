<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListTokenExchangeProfileResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next Opaque identifier for use with the <i>from</i> query parameter for the next page of results.<br/>This identifier is valid for 24 hours.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<TokenExchangeProfileResponseContent> $tokenExchangeProfiles
     */
    #[JsonProperty('token_exchange_profiles'), ArrayType([TokenExchangeProfileResponseContent::class])]
    private ?array $tokenExchangeProfiles;

    /**
     * @param array{
     *   next?: ?string,
     *   tokenExchangeProfiles?: ?array<TokenExchangeProfileResponseContent>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->tokenExchangeProfiles = $values['tokenExchangeProfiles'] ?? null;
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
     * @return ?array<TokenExchangeProfileResponseContent>
     */
    public function getTokenExchangeProfiles(): ?array
    {
        return $this->tokenExchangeProfiles;
    }

    /**
     * @param ?array<TokenExchangeProfileResponseContent> $value
     */
    public function setTokenExchangeProfiles(?array $value = null): self
    {
        $this->tokenExchangeProfiles = $value;
        $this->_setField('tokenExchangeProfiles');
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
