<?php

declare(strict_types=1);

namespace Auth0\SDK\Event\Psr14Store;

use Auth0\SDK\Contract\Auth0Event;
use Auth0\SDK\Contract\StoreInterface;

final class Set implements Auth0Event
{
    private StoreInterface $store;
    private string $key;
    private ?bool $success = null;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param StoreInterface $store
     * @param string $key
     * @param mixed $value
     */
    public function __construct(
        StoreInterface $store,
        string $key,
        $value
    ) {
        $this->store = $store;
        $this->key = $key;
        $this->value = $value;
    }

    public function getStore(): StoreInterface
    {
        return $this->store;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccess(
        ?bool $success
    ): self {
        $this->success = $success;
        return $this;
    }
}
