<?php

namespace Auth0\SDK\API\Management\ResourceServers\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class GetResourceServerRequestParameters extends JsonSerializableType
{
    /**
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false).
     */
    private ?bool $includeFields;

    /**
     * @param array{
     *   includeFields?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->includeFields = $values['includeFields'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getIncludeFields(): ?bool
    {
        return $this->includeFields;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeFields(?bool $value = null): self
    {
        $this->includeFields = $value;
        $this->_setField('includeFields');
        return $this;
    }
}
