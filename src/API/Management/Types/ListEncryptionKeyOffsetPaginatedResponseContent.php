<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListEncryptionKeyOffsetPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?int $start Page index of the results to return. First page is 0.
     */
    #[JsonProperty('start')]
    private ?int $start;

    /**
     * @var ?int $limit Number of results per page.
     */
    #[JsonProperty('limit')]
    private ?int $limit;

    /**
     * @var ?int $total Total amount of encryption keys.
     */
    #[JsonProperty('total')]
    private ?int $total;

    /**
     * @var ?array<EncryptionKey> $keys Encryption keys.
     */
    #[JsonProperty('keys'), ArrayType([EncryptionKey::class])]
    private ?array $keys;

    /**
     * @param array{
     *   start?: ?int,
     *   limit?: ?int,
     *   total?: ?int,
     *   keys?: ?array<EncryptionKey>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->start = $values['start'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->total = $values['total'] ?? null;
        $this->keys = $values['keys'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getStart(): ?int
    {
        return $this->start;
    }

    /**
     * @param ?int $value
     */
    public function setStart(?int $value = null): self
    {
        $this->start = $value;
        $this->_setField('start');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param ?int $value
     */
    public function setLimit(?int $value = null): self
    {
        $this->limit = $value;
        $this->_setField('limit');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * @param ?int $value
     */
    public function setTotal(?int $value = null): self
    {
        $this->total = $value;
        $this->_setField('total');
        return $this;
    }

    /**
     * @return ?array<EncryptionKey>
     */
    public function getKeys(): ?array
    {
        return $this->keys;
    }

    /**
     * @param ?array<EncryptionKey> $value
     */
    public function setKeys(?array $value = null): self
    {
        $this->keys = $value;
        $this->_setField('keys');
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
