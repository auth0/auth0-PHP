<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\Contract\ConfigurableContract;
use Auth0\SDK\Mixins\ConfigurableMixin;

class MockConfiguration implements ConfigurableContract
{
    use ConfigurableMixin;

    public function __construct(
        private ?array $configuration = null,
        public ?string $validStringProperty = null,
        public ?array $validArrayProperty = null,
        public ?int $validIntProperty = null,
        public ?string $stringPropertyNoSetter = null,
        public ?string $stringPropertyNoValidator = null,
        public ?string $stringPropertyNoDefault = null,
    ) {
        if (null !== $configuration && [] !== $configuration) {
            $this->applyConfiguration($configuration);
        }

        $this->validateProperties();
    }

    public function setValidStringProperty(?string $validStringProperty = null): self
    {
        $validStringProperty = trim($validStringProperty ?? '');

        if ('' === $validStringProperty) {
            $validStringProperty = null;
        }

        $this->validStringProperty = $validStringProperty;

        return $this;
    }

    public function getValidStringProperty(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->validStringProperty, $exceptionIfNull);

        return $this->validStringProperty;
    }

    public function hasValidStringProperty(): bool
    {
        return null !== $this->validStringProperty;
    }

    public function setValidArrayProperty(?array $validArrayProperty): self
    {
        $this->validArrayProperty = $this->filterArray($validArrayProperty);

        if ([] === $validArrayProperty) {
            $validArrayProperty = null;
        }

        return $this;
    }

    public function gethValidArrayProperty(?\Throwable $exceptionIfNull = null): ?array
    {
        $this->exceptionIfNull($this->validArrayProperty, $exceptionIfNull);

        return $this->validArrayProperty;
    }

    public function hashValidArrayProperty(): bool
    {
        return null !== $this->validArrayProperty;
    }

    public function pushValidArrayProperty(array|string $validArrayProperty): ?array
    {
        if (\is_string($validArrayProperty)) {
            $validArrayProperty = [$validArrayProperty];
        }

        $this->setValidArrayProperty(array_merge($this->validArrayProperty ?? [], $validArrayProperty));

        return $this->validArrayProperty;
    }

    public function setValidIntProperty(?int $validIntProperty = null): self
    {
        if (null !== $validIntProperty && $validIntProperty < 0) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('validIntProperty');
        }

        $this->validIntProperty = $validIntProperty;

        return $this;
    }

    public function getValidIntProperty(?\Throwable $exceptionIfNull = null): ?int
    {
        $this->exceptionIfNull($this->validIntProperty, $exceptionIfNull);

        return $this->validIntProperty;
    }

    public function hasValidIntProperty(): bool
    {
        return null !== $this->validIntProperty;
    }

    public function getStringPropertyNoSetter(?\Throwable $exceptionIfNull = null): ?int
    {
        $this->exceptionIfNull($this->stringPropertyNoSetter, $exceptionIfNull);

        return $this->stringPropertyNoSetter;
    }

    public function hasStringPropertyNoSetter(): bool
    {
        return null !== $this->stringPropertyNoSetter;
    }

    private function getPropertyValidators(): array
    {
        return [
            'validStringProperty'     => static fn ($value) => \is_string($value) || null === $value,
            'validArrayProperty'      => static fn ($value) => \is_array($value) || null === $value,
            'validIntProperty'        => static fn ($value) => \is_int($value) || null === $value,
            'stringPropertyNoSetter'  => static fn ($value) => \is_string($value) || null === $value,
            'stringPropertyNoDefault' => static fn ($value) => \is_string($value) || null === $value,
            'nonexistentProperty'     => static fn ($value) => \is_string($value) || null === $value,
        ];
    }

    private function getPropertyDefaults(): array
    {
        return [
            'validStringProperty'       => null,
            'validArrayProperty'        => null,
            'validIntProperty'          => null,
            'stringPropertyNoSetter'    => null,
            'stringPropertyNoValidator' => null,
            'nonexistentProperty'       => null,
        ];
    }
}
