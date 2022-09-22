<?php

declare(strict_types=1);

namespace Auth0\SDK\Event\Psr14Store;

use Auth0\SDK\Contract\Auth0Event;
use Auth0\SDK\Contract\StoreInterface;

final class Boot implements Auth0Event
{
    private StoreInterface $store;
    private string $prefix;

    public function __construct(
        StoreInterface $store,
        string $prefix
    ) {
        $this->store = $store;
        $this->prefix = $prefix;
    }

    public function getStore(): StoreInterface
    {
        return $this->store;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function setPrefix(
        string $prefix
    ): self {
        $this->prefix = $prefix;
        return $this;
    }
}
