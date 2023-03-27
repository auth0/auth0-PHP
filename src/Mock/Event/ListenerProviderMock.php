<?php

declare(strict_types=1);

namespace Auth0\SDK\Mock\Event;

use Psr\EventDispatcher\ListenerProviderInterface;

final class ListenerProviderMock implements ListenerProviderInterface
{
    /**
     * @var ListenerEntityMock[] Listeners to execute when an event is triggered.
     */
    private array $listeners = [];

    /**
     * @param null|object|string $event    Event class name or instance to listen for.
     * @param null|callable      $listener Callable to execute when the event is triggered.
     * @param int                $priority Priority of the listener. Lower numbers are executed first.
     */
    public function __construct(
        string | object | null $event = null,
        callable | null $listener = null,
        int $priority = 0,
    ) {
        if (null !== $event && null !== $listener) {
            $this->on($event, $listener, $priority);
        }
    }

    /**
     * @param object|string $event Event class name or instance to listen for.
     *
     * @return array<callable> Listeners to execute when the event is triggered.
     */
    public function getListenersForEvent(
        string | object $event,
    ): array {
        $queue = [];

        foreach ($this->listeners as $listener) {
            if ($event instanceof $listener->event || $event === $listener->eventClass) {
                $queue[] = $listener->listener;
            }
        }

        return $queue;
    }

    /**
     * @param object|string $event    Event class name or instance to listen for.
     * @param callable      $listener Callable to execute when the event is triggered.
     * @param int           $priority Priority of the listener. Lower numbers are executed first.
     */
    public function on(
        string | object $event,
        callable $listener,
        int $priority = 0,
    ): self {
        $this->listeners[] = new ListenerEntityMock($event, $listener, $priority);

        return $this;
    }

    /**
     * @param object|string $event    Event class name or instance to listen for.
     * @param callable      $listener Callable to execute when the event is triggered.
     * @param int           $priority Priority of the listener. Lower numbers are executed first.
     */
    public static function create(
        string | object $event,
        callable $listener,
        int $priority = 0,
    ): self {
        return new self($event, $listener, $priority);
    }
}
