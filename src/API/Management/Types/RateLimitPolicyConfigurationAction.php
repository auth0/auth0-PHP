<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class RateLimitPolicyConfigurationAction extends JsonSerializableType
{
    /**
     * @var value-of<RateLimitPolicyConfigurationActionAction> $action Determines the action to take when the rate limit is exceeded.
     */
    #[JsonProperty('action')]
    private string $action;

    /**
     * @var int $limit The maximum number of requests allowed in a single refresh window.
     */
    #[JsonProperty('limit')]
    private int $limit;

    /**
     * @var string $redirectUri The HTTPS URI to redirect to when the rate limit is exceeded.
     */
    #[JsonProperty('redirect_uri')]
    private string $redirectUri;

    /**
     * @param array{
     *   action: value-of<RateLimitPolicyConfigurationActionAction>,
     *   limit: int,
     *   redirectUri: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->limit = $values['limit'];
        $this->redirectUri = $values['redirectUri'];
    }

    /**
     * @return value-of<RateLimitPolicyConfigurationActionAction>
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param value-of<RateLimitPolicyConfigurationActionAction> $value
     */
    public function setAction(string $value): self
    {
        $this->action = $value;
        $this->_setField('action');
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $value
     */
    public function setLimit(int $value): self
    {
        $this->limit = $value;
        $this->_setField('limit');
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    /**
     * @param string $value
     */
    public function setRedirectUri(string $value): self
    {
        $this->redirectUri = $value;
        $this->_setField('redirectUri');
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
