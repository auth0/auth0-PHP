<?php

declare(strict_types=1);

namespace Auth0\SDK\Event\Psr14Store;

use Auth0\SDK\Contract\Auth0Event;
use Auth0\SDK\Contract\StoreInterface;

final class Defer implements Auth0Event
{
    private StoreInterface $store;
    private bool $state;

    public function __construct(
        StoreInterface $store,
        bool $state
    ) {
        $this->store = $store;
        $this->state = $state;
    }

    public function getStore(): StoreInterface
    {
        return $this->store;
    }

    public function getState(): bool
    {
        return $this->state;
    }
}
