<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PortalCustomCode extends JsonSerializableType
{
    /**
     * @var ?string $head Custom code injected into the <head> of the portal. Only injected when the portal is accessed via a custom domain; it is not injected on canonical domains.
     */
    #[JsonProperty('head')]
    private ?string $head;

    /**
     * @param array{
     *   head?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->head = $values['head'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getHead(): ?string
    {
        return $this->head;
    }

    /**
     * @param ?string $value
     */
    public function setHead(?string $value = null): self
    {
        $this->head = $value;
        $this->_setField('head');
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
