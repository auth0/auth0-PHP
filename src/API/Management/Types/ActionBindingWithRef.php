<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ActionBindingWithRef extends JsonSerializableType
{
    /**
     * @var ActionBindingRef $ref
     */
    #[JsonProperty('ref')]
    private ActionBindingRef $ref;

    /**
     * @var ?string $displayName The name of the binding.
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?array<ActionSecretRequest> $secrets The list of secrets that are included in an action or a version of an action.
     */
    #[JsonProperty('secrets'), ArrayType([ActionSecretRequest::class])]
    private ?array $secrets;

    /**
     * @param array{
     *   ref: ActionBindingRef,
     *   displayName?: ?string,
     *   secrets?: ?array<ActionSecretRequest>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->ref = $values['ref'];
        $this->displayName = $values['displayName'] ?? null;
        $this->secrets = $values['secrets'] ?? null;
    }

    /**
     * @return ActionBindingRef
     */
    public function getRef(): ActionBindingRef
    {
        return $this->ref;
    }

    /**
     * @param ActionBindingRef $value
     */
    public function setRef(ActionBindingRef $value): self
    {
        $this->ref = $value;
        $this->_setField('ref');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param ?string $value
     */
    public function setDisplayName(?string $value = null): self
    {
        $this->displayName = $value;
        $this->_setField('displayName');
        return $this;
    }

    /**
     * @return ?array<ActionSecretRequest>
     */
    public function getSecrets(): ?array
    {
        return $this->secrets;
    }

    /**
     * @param ?array<ActionSecretRequest> $value
     */
    public function setSecrets(?array $value = null): self
    {
        $this->secrets = $value;
        $this->_setField('secrets');
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
