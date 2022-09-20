<?php

declare(strict_types=1);

namespace Auth0\SDK\Event\Psr14Store;

use Auth0\SDK\Contract\Auth0Event;
use Auth0\SDK\Contract\StoreInterface;

final class Destruct implements Auth0Event
{
    private StoreInterface $store;

    public function __construct(
        StoreInterface $store
    ) {
        $this->store = $store;
    }

    public function getStore(): StoreInterface
    {
        return $this->store;
    }
}
