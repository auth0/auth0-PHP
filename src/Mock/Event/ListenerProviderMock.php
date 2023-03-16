<?php

declare(strict_types=1);

namespace Auth0\SDK\Mock\Event;

use Psr\EventDispatcher\ListenerProviderInterface;

final class ListenerProviderMock implements ListenerProviderInterface
{
    private array $listeners = [];

    public function __construct(
        string|object|null $event = null,
        callable|null $listener = null,
        int $priority = 0
    ) {
        if (null !== $event && null !== $listener) {
            $this->on($event, $listener, $priority);
        }
    }

    public static function create(
        string|object $event,
        callable $listener,
        int $priority = 0
    ): self {
        return new self($event, $listener, $priority);
    }

    public function getListenersForEvent(
        string|object $event
    ): iterable {
        $queue = [];

        foreach ($this->listeners as $listener) {
            if ($event instanceof $listener->event || $event === $listener->eventClass) {
                $queue[] = $listener->listener;
            }
        }

        return $queue;
    }

    public function on(
        string|object $event,
        callable $listener,
        int $priority = 0
    ): self {
        $this->listeners[] = new ListenerEntityMock($event, $listener, $priority);
        return $this;
    }
}
