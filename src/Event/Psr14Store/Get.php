<?php

declare(strict_types=1);

namespace Auth0\SDK\Event\Psr14Store;

use Auth0\SDK\Contract\Auth0Event;
use Auth0\SDK\Contract\StoreInterface;

final class Get implements Auth0Event
{
    private StoreInterface $store;
    private ?bool $missed = null;
    private ?bool $success = null;
    private string $key;

    /**
     * @var mixed
     */
    private $value;

    public function __construct(
        StoreInterface $store,
        string $key
    ) {
        $this->store = $store;
        $this->key = $key;
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
        return $this->value ?? null;
    }

    /**
     * @param mixed $value
     */
    public function setValue(
        $value
    ): self {
        $this->value = $value;
        return $this;
    }

    public function getMissed(): ?bool
    {
        return $this->missed;
    }

    public function setMissed(
        bool $missed
    ): self {
        $this->missed = $missed;
        return $this;
    }

    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccess(
        bool $success
    ): self {
        $this->success = $success;
        return $this;
    }
}
