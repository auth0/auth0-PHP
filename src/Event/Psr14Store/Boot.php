<?php

declare(strict_types=1);

namespace Auth0\SDK\Event\Psr14Store;

use Auth0\SDK\Contract\{Auth0Event, StoreInterface};

final class Boot implements Auth0Event
{
    public function __construct(
        private StoreInterface $store,
        private string $prefix,
    ) {
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getStore(): StoreInterface
    {
        return $this->store;
    }

    public function setPrefix(
        string $prefix,
    ): self {
        $this->prefix = $prefix;

        return $this;
    }
}
