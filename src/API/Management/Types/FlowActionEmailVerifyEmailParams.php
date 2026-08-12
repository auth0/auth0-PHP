<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionEmailVerifyEmailParams extends JsonSerializableType
{
    /**
     * @var string $email
     */
    #[JsonProperty('email')]
    private string $email;

    /**
     * @var ?FlowActionEmailVerifyEmailParamsRules $rules
     */
    #[JsonProperty('rules')]
    private ?FlowActionEmailVerifyEmailParamsRules $rules;

    /**
     * @param array{
     *   email: string,
     *   rules?: ?FlowActionEmailVerifyEmailParamsRules,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->email = $values['email'];
        $this->rules = $values['rules'] ?? null;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $value
     */
    public function setEmail(string $value): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?FlowActionEmailVerifyEmailParamsRules
     */
    public function getRules(): ?FlowActionEmailVerifyEmailParamsRules
    {
        return $this->rules;
    }

    /**
     * @param ?FlowActionEmailVerifyEmailParamsRules $value
     */
    public function setRules(?FlowActionEmailVerifyEmailParamsRules $value = null): self
    {
        $this->rules = $value;
        $this->_setField('rules');
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
