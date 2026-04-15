<?php

namespace Auth0\SDK\API\Management\Actions\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class DeleteActionRequestParameters extends JsonSerializableType
{
    /**
     * @var ?bool $force Force action deletion detaching bindings
     */
    private ?bool $force;

    /**
     * @param array{
     *   force?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->force = $values['force'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getForce(): ?bool
    {
        return $this->force;
    }

    /**
     * @param ?bool $value
     */
    public function setForce(?bool $value = null): self
    {
        $this->force = $value;
        $this->_setField('force');
        return $this;
    }
}
