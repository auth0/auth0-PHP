<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Mock\Event\ListenerProviderMock;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

uses()->group('utility', 'utility.event_dispatcher');

test('dispatch() functions as expected', function(): void {
    $event = new class() implements StoppableEventInterface {
        public int $id = 123;
        public bool $hit = false;
        public bool $stopped = false;

        public function isPropagationStopped(): bool {
            return $this->stopped;
        }
    };

    $listener = ListenerProviderMock::create($event, function($test) {
        $test->hit = true;
        return $test;
    });

    $configuration = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE,
        'eventListenerProvider' => $listener
    ]);

    expect($configuration->getEventListenerProvider())->toBeInstanceOf(ListenerProviderInterface::class);

    $event = $configuration->eventDispatcher()->dispatch($event);

    expect($event)
        ->hit->toBeTrue()
        ->id->toEqual(123)
        ->isPropagationStopped()->toBeFalse();

    $event->stopped = true;
    $event = $configuration->eventDispatcher()->dispatch($event);

    expect($event)
        ->hit->toBeTrue()
        ->id->toEqual(123)
        ->isPropagationStopped()->toBeTrue();
});
