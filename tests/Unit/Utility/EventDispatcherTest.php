<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Hyperf\Event\ListenerProvider;
use Psr\EventDispatcher\StoppableEventInterface;

uses()->group('utility', 'utility.event_dispatcher');

test('dispatch() functions as expected', function(): void {
    $mockEvent = new class() implements StoppableEventInterface {
        public int $id = 123;
        public bool $hit = false;
        public bool $stopped = false;

        public function isPropagationStopped(): bool {
            return $this->stopped;
        }
    };

    $listener = new ListenerProvider();

    $listener->on(get_class($mockEvent), function($test) {
        $test->hit = true;
        return $test;
    });

    $configuration = new SdkConfiguration([
        'strategy' => 'none',
        'eventListenerProvider' => $listener
    ]);

    expect($configuration->getEventListenerProvider())->toBeInstanceOf(ListenerProvider::class);

    $mockEvent = $configuration->eventDispatcher()->dispatch($mockEvent);

    expect($mockEvent)
        ->hit->toBeTrue()
        ->id->toEqual(123)
        ->isPropagationStopped()->toBeFalse();

    $mockEvent->stopped = true;

    $mockEvent = $configuration->eventDispatcher()->dispatch($mockEvent);

    expect($mockEvent)
        ->hit->toBeTrue()
        ->id->toEqual(123)
        ->isPropagationStopped()->toBeTrue();
});
