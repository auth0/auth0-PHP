<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class NetworkAclRule extends JsonSerializableType
{
    /**
     * @var NetworkAclAction $action
     */
    #[JsonProperty('action')]
    private NetworkAclAction $action;

    /**
     * @var ?NetworkAclMatch $match
     */
    #[JsonProperty('match')]
    private ?NetworkAclMatch $match;

    /**
     * @var ?NetworkAclMatch $notMatch
     */
    #[JsonProperty('not_match')]
    private ?NetworkAclMatch $notMatch;

    /**
     * @var value-of<NetworkAclRuleScopeEnum> $scope
     */
    #[JsonProperty('scope')]
    private string $scope;

    /**
     * @param array{
     *   action: NetworkAclAction,
     *   scope: value-of<NetworkAclRuleScopeEnum>,
     *   match?: ?NetworkAclMatch,
     *   notMatch?: ?NetworkAclMatch,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->match = $values['match'] ?? null;
        $this->notMatch = $values['notMatch'] ?? null;
        $this->scope = $values['scope'];
    }

    /**
     * @return NetworkAclAction
     */
    public function getAction(): NetworkAclAction
    {
        return $this->action;
    }

    /**
     * @param NetworkAclAction $value
     */
    public function setAction(NetworkAclAction $value): self
    {
        $this->action = $value;
        $this->_setField('action');
        return $this;
    }

    /**
     * @return ?NetworkAclMatch
     */
    public function getMatch(): ?NetworkAclMatch
    {
        return $this->match;
    }

    /**
     * @param ?NetworkAclMatch $value
     */
    public function setMatch(?NetworkAclMatch $value = null): self
    {
        $this->match = $value;
        $this->_setField('match');
        return $this;
    }

    /**
     * @return ?NetworkAclMatch
     */
    public function getNotMatch(): ?NetworkAclMatch
    {
        return $this->notMatch;
    }

    /**
     * @param ?NetworkAclMatch $value
     */
    public function setNotMatch(?NetworkAclMatch $value = null): self
    {
        $this->notMatch = $value;
        $this->_setField('notMatch');
        return $this;
    }

    /**
     * @return value-of<NetworkAclRuleScopeEnum>
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @param value-of<NetworkAclRuleScopeEnum> $value
     */
    public function setScope(string $value): self
    {
        $this->scope = $value;
        $this->_setField('scope');
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
