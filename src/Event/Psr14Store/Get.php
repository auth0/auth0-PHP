<?php

declare(strict_types=1);

namespace Auth0\SDK\Event\Psr14Store;

use Auth0\SDK\Contract\{Auth0Event, StoreInterface};

final class Get implements Auth0Event
{
    private ?bool $missed = null;

    private ?bool $success = null;

    /**
     * @var mixed
     */
    private $value;

    public function __construct(
        private StoreInterface $store,
        private string $key,
    ) {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getMissed(): ?bool
    {
        return $this->missed;
    }

    public function getStore(): StoreInterface
    {
        return $this->store;
    }

    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value ?? null;
    }

    public function setMissed(
        bool $missed,
    ): self {
        $this->missed = $missed;

        return $this;
    }

    public function setSuccess(
        bool $success,
    ): self {
        $this->success = $success;

        return $this;
    }

    /**
     * @param mixed $value
     */
    public function setValue(
        $value,
    ): self {
        $this->value = $value;

        return $this;
    }
}
