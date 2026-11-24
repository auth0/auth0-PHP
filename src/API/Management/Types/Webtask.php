<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * A webtask in the tenant's container, as returned by the webtask platform.
 */
class Webtask extends JsonSerializableType
{
    /**
     * @var string $container
     */
    #[JsonProperty('container')]
    private string $container;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $token
     */
    #[JsonProperty('token')]
    private ?string $token;

    /**
     * @var array<string, string> $meta
     */
    #[JsonProperty('meta'), ArrayType(['string' => 'string'])]
    private array $meta;

    /**
     * @var ?string $webtaskUrl
     */
    #[JsonProperty('webtask_url')]
    private ?string $webtaskUrl;

    /**
     * @param array{
     *   container: string,
     *   name: string,
     *   meta: array<string, string>,
     *   token?: ?string,
     *   webtaskUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->container = $values['container'];
        $this->name = $values['name'];
        $this->token = $values['token'] ?? null;
        $this->meta = $values['meta'];
        $this->webtaskUrl = $values['webtaskUrl'] ?? null;
    }

    /**
     * @return string
     */
    public function getContainer(): string
    {
        return $this->container;
    }

    /**
     * @param string $value
     */
    public function setContainer(string $value): self
    {
        $this->container = $value;
        $this->_setField('container');
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param ?string $value
     */
    public function setToken(?string $value = null): self
    {
        $this->token = $value;
        $this->_setField('token');
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @param array<string, string> $value
     */
    public function setMeta(array $value): self
    {
        $this->meta = $value;
        $this->_setField('meta');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getWebtaskUrl(): ?string
    {
        return $this->webtaskUrl;
    }

    /**
     * @param ?string $value
     */
    public function setWebtaskUrl(?string $value = null): self
    {
        $this->webtaskUrl = $value;
        $this->_setField('webtaskUrl');
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
