<?php

declare(strict_types=1);

namespace Auth0\SDK\Event\Psr14Store;

use Auth0\SDK\Contract\{Auth0Event, StoreInterface};

final class Defer implements Auth0Event
{
    public function __construct(
        private StoreInterface $store,
        private bool $state,
    ) {
    }

    public function getState(): bool
    {
        return $this->state;
    }

    public function getStore(): StoreInterface
    {
        return $this->store;
    }
}
