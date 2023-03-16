<?php

declare(strict_types=1);

namespace Auth0\SDK\Mock\Event;

final class ListenerEntityMock
{
    public $listener;
    public string $eventClass;

    public function __construct(
        public string|object $event,
        callable $listener,
        public int $priority = 0
    )
    {
        $this->listener = $listener;

        if (is_string($event)) {
            $this->eventClass = $event;
            return;
        }

        $this->eventClass = get_class($event);
    }
}
