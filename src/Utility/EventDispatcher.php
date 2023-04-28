<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Configuration\SdkConfiguration;
use Psr\EventDispatcher\{EventDispatcherInterface, ListenerProviderInterface, StoppableEventInterface};
use stdClass;

final class EventDispatcher implements EventDispatcherInterface
{
    /**
     * EventDispatcher constructor.
     *
     * @param SdkConfiguration $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     */
    public function __construct(
        private SdkConfiguration $configuration,
    ) {
    }

    /**
     * Dispatch an event to any subscribed listeners.
     *
     * @param object $event the event to be dispatched to listeners
     *
     * @psalm-suppress MixedFunctionCall
     */
    public function dispatch(
        object $event,
    ): object {
        $listenerProvider = $this->getListenerProvider();

        if (! $listenerProvider instanceof ListenerProviderInterface) {
            return new stdClass();
        }

        $listeners = $listenerProvider->getListenersForEvent($event);

        foreach ($listeners as $listener) {
            if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
                break;
            }

            $listener($event);
        }

        return $event;
    }

    public function getListenerProvider(): ?ListenerProviderInterface
    {
        $listenerProvider = $this->configuration->getEventListenerProvider();

        return $listenerProvider instanceof ListenerProviderInterface ? $listenerProvider : null;
    }
}
