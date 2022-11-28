<?php

declare(strict_types=1);

namespace Auth0\SDK\Event\Psr14Store;

use Auth0\SDK\Contract\Auth0Event;
use Auth0\SDK\Contract\StoreInterface;

final class Delete implements Auth0Event
{
    private ?bool $success = null;

    public function __construct(
        private StoreInterface $store,
        private string $key,
    ) {
    }

    public function getStore(): StoreInterface
    {
        return $this->store;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccess(
        ?bool $success,
    ): self {
        $this->success = $success;

        return $this;
    }
}
