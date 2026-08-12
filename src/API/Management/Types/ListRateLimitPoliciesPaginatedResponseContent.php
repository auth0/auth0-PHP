<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListRateLimitPoliciesPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<RateLimitPolicy> $rateLimitPolicies
     */
    #[JsonProperty('rate_limit_policies'), ArrayType([RateLimitPolicy::class])]
    private ?array $rateLimitPolicies;

    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   rateLimitPolicies?: ?array<RateLimitPolicy>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->rateLimitPolicies = $values['rateLimitPolicies'] ?? null;
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return ?array<RateLimitPolicy>
     */
    public function getRateLimitPolicies(): ?array
    {
        return $this->rateLimitPolicies;
    }

    /**
     * @param ?array<RateLimitPolicy> $value
     */
    public function setRateLimitPolicies(?array $value = null): self
    {
        $this->rateLimitPolicies = $value;
        $this->_setField('rateLimitPolicies');
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
