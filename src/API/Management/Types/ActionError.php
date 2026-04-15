<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Error is a generic error with a human readable id which should be easily referenced in support tickets.
 */
class ActionError extends JsonSerializableType
{
    /**
     * @var ?string $id
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $msg
     */
    #[JsonProperty('msg')]
    private ?string $msg;

    /**
     * @var ?string $url
     */
    #[JsonProperty('url')]
    private ?string $url;

    /**
     * @param array{
     *   id?: ?string,
     *   msg?: ?string,
     *   url?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->msg = $values['msg'] ?? null;
        $this->url = $values['url'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMsg(): ?string
    {
        return $this->msg;
    }

    /**
     * @param ?string $value
     */
    public function setMsg(?string $value = null): self
    {
        $this->msg = $value;
        $this->_setField('msg');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param ?string $value
     */
    public function setUrl(?string $value = null): self
    {
        $this->url = $value;
        $this->_setField('url');
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
