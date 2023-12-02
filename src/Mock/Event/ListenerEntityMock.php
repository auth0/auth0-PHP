<?php

declare(strict_types=1);

namespace Auth0\SDK\Mock\Event;

use function is_string;

final class ListenerEntityMock
{
    public string $eventClass;

    /**
     * @var callable Callable to execute when the event is triggered.
     */
    public $listener;

    /**
     * @param object|string $event    Event class name or instance to listen for.
     * @param callable      $listener Callable to execute when the event is triggered.
     * @param int           $priority Priority of the listener. Lower numbers are executed first.
     */
    public function __construct(
        public string | object $event,
        callable $listener,
        public int $priority = 0,
    ) {
        $this->listener = $listener;

        if (is_string($event)) {
            $this->eventClass = $event;

            return;
        }

        $this->eventClass = $event::class;
    }
}
