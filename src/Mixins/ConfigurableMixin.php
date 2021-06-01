<?php

declare(strict_types=1);

namespace Auth0\SDK\Mixins;

trait ConfigurableMixin
{
    private array $configuredState = [];
    private array $configuredValidations = [];
    private bool $configurationImmutable = false;
    private array $configuredValidationsLambdas = [];

    public function __call(
        string $functionName,
        array $arguments
    ) {
        if (mb_strlen($functionName) > 4 && mb_substr($functionName, 0, 3) === 'get' && ! $arguments) {
            $propertyName = lcfirst(mb_substr($functionName, 3));

            if (isset($this->configuredState[$propertyName])) {
                $propertyValue = $this->configuredState[$propertyName]->value;

                if (method_exists($this, 'handleStateChange') && is_callable([$this, 'handleStateChange'])) {
                    return $this->handleStateChange($propertyName, $propertyValue);
                }

                return $propertyValue;
            }

            throw \Auth0\SDK\Exception\ConfigurationException::getMissing($propertyName);
        }

        if (mb_strlen($functionName) > 4 && mb_substr($functionName, 0, 3) === 'set' && $arguments) {
            $propertyName = lcfirst(mb_substr($functionName, 3));
            $this->changeState($propertyName, $arguments[0]);
            return $this;
        }

        if (mb_strlen($functionName) > 4 && mb_substr($functionName, 0, 3) === 'has' && ! $arguments) {
            $propertyName = lcfirst(mb_substr($functionName, 3));

            if (isset($this->configuredState[$propertyName])) {
                return $this->configuredState[$propertyName]->value !== null;
            }

            throw \Auth0\SDK\Exception\ConfigurationException::getMissing($propertyName);
        }
    }

    public function lock(): self
    {
        $this->configurationImmutable = true;
        return $this;
    }

    public function validate(): self
    {
        foreach ($this->configuredValidations as $condition) {
            if (is_string($condition) && mb_strlen($condition) > 4 && (mb_substr($condition, 0, 3) === 'get' || mb_substr($condition, 0, 3) === 'has')) {
                $propertyName = lcfirst(mb_substr($condition, 3));

                if (isset($this->configuredState[$propertyName])) {
                    $lambda = function () use ($condition) {
                        return call_user_func([$this, $condition]) !== null;
                    };

                    if (! $lambda()) {
                        if (method_exists($this, 'onValidationException') && is_callable([$this, 'onValidationException'])) {
                            $this->onValidationException($propertyName);
                        }

                        throw \Auth0\SDK\Exception\ConfigurationException::validationFailed($propertyName);
                    }
                }
            }
        }

        return $this;
    }

    public function reset(): self
    {
        foreach ($this->configuredState as $parameterKey => $parameterValue) {
            $this->configuredState[$parameterKey]->value = $parameterValue->defaultValue;
        }

        return $this;
    }

    private function setState(
        ...$args
    ): self {
        $this->configuredState = [];

        // phpcs:ignore
        // TODO: Replace get_class() w/ ::class when 7.x support is dropped.

        // phpcs:ignore
        $constructor = new \ReflectionMethod(get_class($this) . '::__construct');
        $parameters = $constructor->getParameters();
        $arguments = $args[0];
        $usingArgumentsArray = false;

        if ($parameters) {
            if (
                $parameters[0]->getName() === 'configuration' &&
                $parameters[0]->getType()->getName() === 'array' &&
                $parameters[0]->getPosition() === 0 &&
                $parameters[0]->allowsNull()
            ) {
                $argumentsArray = $arguments[$parameters[0]->getPosition()] ?? null;

                if ($argumentsArray !== null) {
                    $arguments = $arguments[$parameters[0]->getPosition()];
                    $usingArgumentsArray = true;
                }

                array_shift($parameters);
            }

            foreach ($parameters as $parameter) {
                $newProperty = [
                    'allowsNull' => $parameter->allowsNull(),
                    'defaultValue' => null,
                    'type' => $parameter->getType()->getName(),
                ];

                if ($parameter->isDefaultValueAvailable()) {
                    $newProperty['defaultValue'] = $parameter->getDefaultValue();
                }

                $newPropertyName = $parameter->getName();
                $newPropertyValue = $newProperty['defaultValue'];

                if ($arguments) {
                    if ($usingArgumentsArray) {
                        $newPropertyValue = $arguments[$parameter->getName()] ?? $parameter->getDefaultValue();
                    } else {
                        if (isset($arguments[$parameter->getPosition()])) {
                            $newPropertyValue = $arguments[$parameter->getPosition()];
                        }
                    }
                }

                $this->configuredState[$newPropertyName] = (object) $newProperty;
                $this->changeState($newPropertyName, $newPropertyValue);
            }
        }

        return $this;
    }

    private function setValidations(
        array $validations = []
    ): self {
        $this->configuredValidations = $validations;
        return $this;
    }

    private function export(): array
    {
        return $this->configuredState;
    }

    private function changeState(
        string $propertyName,
        $propertyValue
    ): void {
        $propertyType = gettype($propertyValue);
        $expectedType = $this->configuredState[$propertyName]->type;

        if ($this->configurationImmutable) {
            throw \Auth0\SDK\Exception\ConfigurationException::setImmutable();
        }

        if (! isset($this->configuredState[$propertyName])) {
            throw \Auth0\SDK\Exception\ConfigurationException::setMissing($propertyName);
        }

        if ($propertyType !== $expectedType) {
            if (! ($propertyType === 'boolean' && $expectedType === 'bool') &&
                ! ($propertyType === 'integer' && $expectedType === 'int')) {
                if ($propertyValue === null && ! $this->configuredState[$propertyName]->allowsNull) {
                    throw \Auth0\SDK\Exception\ConfigurationException::setIncompatible($propertyName, $expectedType, $propertyType);
                }

                if ($propertyValue !== null && $this->configuredState[$propertyName]->allowsNull) {
                    if (! is_object($propertyValue) || ! ($propertyValue instanceof $expectedType)) {
                        throw \Auth0\SDK\Exception\ConfigurationException::setIncompatibleNullable($propertyName, $expectedType, $propertyType);
                    }
                }
            }
        }

        if (method_exists($this, 'onStateChange') && is_callable([$this, 'onStateChange'])) {
            $propertyValue = $this->onStateChange($propertyName, $propertyValue);
        }

        $this->configuredState[$propertyName]->value = $propertyValue;
    }
}
