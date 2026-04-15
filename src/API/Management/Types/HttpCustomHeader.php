<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class HttpCustomHeader extends JsonSerializableType
{
    /**
     * @var ?string $header HTTP header name
     */
    #[JsonProperty('header')]
    private ?string $header;

    /**
     * @var ?string $value HTTP header value
     */
    #[JsonProperty('value')]
    private ?string $value;

    /**
     * @param array{
     *   header?: ?string,
     *   value?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->header = $values['header'] ?? null;
        $this->value = $values['value'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * @param ?string $value
     */
    public function setHeader(?string $value = null): self
    {
        $this->header = $value;
        $this->_setField('header');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param ?string $value
     */
    public function setValue(?string $value = null): self
    {
        $this->value = $value;
        $this->_setField('value');
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
