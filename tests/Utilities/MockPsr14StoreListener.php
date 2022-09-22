<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\Contract\Auth0Event;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Event\Psr14Store\Boot;
use Auth0\SDK\Event\Psr14Store\Clear;
use Auth0\SDK\Event\Psr14Store\Defer;
use Auth0\SDK\Event\Psr14Store\Delete;
use Auth0\SDK\Event\Psr14Store\Destruct;
use Auth0\SDK\Event\Psr14Store\Get;
use Auth0\SDK\Event\Psr14Store\Set;
use Hyperf\Event\ListenerProvider;
use Psr\EventDispatcher\ListenerProviderInterface;

class MockPsr14StoreListener
{
    public ListenerProvider $listener;
    public bool $booted = false;
    public bool $destructed = false;
    public bool $deferred = false;
    public array $data = [];
    public bool $success = true;
    public ?string $prefix = null;
    public ?StoreInterface $store = null;

    public function setup(): ListenerProviderInterface
    {
        $listener = new ListenerProvider();

        $listener->on(Boot::class, function (Boot $event): MockPsr14StoreListener {
            return $this->onBoot($event);
        });

        $listener->on(Destruct::class, function (Destruct $event): MockPsr14StoreListener {
            return $this->onDestruct($event);
        });

        $listener->on(Defer::class, function (Defer $event): MockPsr14StoreListener {
            return $this->onDefer($event);
        });

        $listener->on(Get::class, function (Get $event): Auth0Event {
            return $this->onGet($event);
        });

        $listener->on(Set::class, function (Set $event): Auth0Event {
            return $this->onSet($event);
        });

        $listener->on(Delete::class, function (Delete $event): Auth0Event {
            return $this->onDelete($event);
        });

        $listener->on(Clear::class, function (Clear $event): Auth0Event {
            return $this->onClear($event);
        });

        return $listener;
    }

    public function succeed(): self
    {
        $this->success = true;
        return $this;
    }

    public function fail(): self
    {
        $this->success = false;
        return $this;
    }

    public function onBoot(Boot $event): self
    {
        $this->store = $event->getStore();

        $prefix = $event->getPrefix();
        $event->setPrefix($prefix . '123');
        $this->prefix = $event->getPrefix();

        $this->booted = true;
        return $this;
    }

    public function onDestruct(Destruct $event): self
    {
        $this->destructed = true;
        return $this;
    }

    public function onDefer(Defer $event): self
    {
        $this->deferred = $event->getState();
        return $this;
    }

    /**
     * @param Get $event
     * @return mixed
     */
    public function onGet(Get $event): Auth0Event
    {
        if (! isset($this->data[$event->getKey()])) {
            $event->setMissed(true);
            return $event;
        }

        $event->setSuccess($this->success);
        $event->setValue($this->data[$event->getKey()]);
        return $event;
    }

    public function onSet(Set $event): Auth0Event
    {
        $this->data[$event->getKey()] = $event->getValue();
        $event->setSuccess($this->success);
        return $event;
    }

    public function onDelete(Delete $event): Auth0Event
    {
        unset($this->data[$event->getKey()]);
        $event->setSuccess($this->success);
        return $event;
    }

    public function onClear(Clear $event): Auth0Event
    {
        $this->data = [];
        $event->setSuccess($this->success);
        return $event;
    }
}
