<?php

declare(strict_types=1);

namespace Auth0\SDK\Mixins;

use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Utility\Toolkit;

trait ConfigurableMixin
{
    /**
     * Tracks the state of the current configuration.
     *
     * @var array<object>
     */
    private array $configuredState = [];

    /**
     * When true, changes can no longer be applied to the configuration.
     */
    private bool $configurationImmutable = false;

    /**
     * Handler for get{VariableName}(), set{VariableName}(), push{VariableName}(), and has{VariableName}() "magic" functions.
     *
     * @param string       $functionName The name of the magic function being invoked.
     * @param array<mixed> $arguments    Any arguments being passed to the magic function.
     *
     * @return mixed|void
     *
     * @throws ConfigurationException When a magic function is used improperly.
     */
    public function __call(
        string $functionName,
        array $arguments
    ) {
        if (mb_strlen($functionName) > 4 && mb_substr($functionName, 0, 3) === 'get' && count($arguments) <= 1) {
            $propertyName = lcfirst(mb_substr($functionName, 3));

            if (isset($this->configuredState[$propertyName])) {
                $value = $this->configuredState[$propertyName]->value;

                if (count($arguments) === 1 && $arguments[0] !== null && $this->configuredState[$propertyName]->allowsNull && $value === null) {
                    if ($arguments[0] instanceof \Throwable) {
                        throw $arguments[0];
                    }

                    throw \Auth0\SDK\Exception\ConfigurationException::required($propertyName);
                }

                return $value;
            }

            throw \Auth0\SDK\Exception\ConfigurationException::getMissing($propertyName);
        }

        if (mb_strlen($functionName) > 4 && mb_substr($functionName, 0, 3) === 'set' && count($arguments) !== 0) {
            $propertyName = lcfirst(mb_substr($functionName, 3));
            $this->changeState($propertyName, $arguments[0]);
            return $this;
        }

        if (mb_strlen($functionName) > 5 && mb_substr($functionName, 0, 4) === 'push' && count($arguments) !== 0) {
            $propertyName = lcfirst(mb_substr($functionName, 4));

            if (isset($this->configuredState[$propertyName])) {
                if (! is_array($arguments[0])) {
                    $arguments[0] = [ $arguments[0] ];
                }

                $arguments = array_filter(
                    Toolkit::filter($arguments)->array()->trim(),
                    static function ($val): bool {
                        return $val !== null && count($val) !== 0;
                    }
                );

                if (count($arguments) !== 0) {
                    if (is_array($this->configuredState[$propertyName]->value)) {
                        $this->changeState($propertyName, array_merge($this->configuredState[$propertyName]->value, $arguments[0]));
                        return $this;
                    }

                    $this->changeState($propertyName, $arguments[0]);
                    return $this;
                }

                return $this;
            }

            throw \Auth0\SDK\Exception\ConfigurationException::getMissing($propertyName);
        }

        if (mb_strlen($functionName) > 4 && mb_substr($functionName, 0, 3) === 'has' && count($arguments) === 0) {
            $propertyName = lcfirst(mb_substr($functionName, 3));

            if (isset($this->configuredState[$propertyName])) {
                return $this->configuredState[$propertyName]->value !== null;
            }

            throw \Auth0\SDK\Exception\ConfigurationException::getMissing($propertyName);
        }

        throw \Auth0\SDK\Exception\ArgumentException::unknownMethod($functionName);
    }

    /**
     * Make the configuration immutable, so changes can no longer be applied. Once locked the configuration cannot be unlocked.
     */
    public function lock(): self
    {
        $this->configurationImmutable = true;
        return $this;
    }

    /**
     * Restore all aspects of the configuration to it's default values.
     *
     * @throws ConfigurationException When the configuration has been locked.
     */
    public function reset(): self
    {
        if ($this->configurationImmutable) {
            throw \Auth0\SDK\Exception\ConfigurationException::setImmutable();
        }

        foreach ($this->configuredState as $parameterKey => $parameterValue) {
            $this->configuredState[$parameterKey]->value = $parameterValue->defaultValue;
        }

        return $this;
    }

    /**
     * Import the configuration from an arguments array imported from a __constructor() method.
     *
     * @param mixed $args One or more of arguments from a class __constructor().
     *
     * @throws \ReflectionException When the class or method does not exist.
     * @throws ConfigurationException When the configuration is locked, or an invalid property type is used.
     */
    private function setState(
        ...$args
    ): self {
        $this->configuredState = [];

        // phpcs:ignore
        // TODO: Replace get_class() w/ ::class when 7.x support is dropped.

        // phpcs:ignore
        $constructor = new \ReflectionMethod(get_class($this), '__construct');
        $parameters = $constructor->getParameters();
        $arguments = $args[0];
        $usingArgumentsArray = false;

        if (count($parameters) !== 0) {
            $typeName = $parameters[0]->getType();

            if ($typeName instanceof \ReflectionNamedType) {
                $typeName = $typeName->getName();
            }

            if (
                $parameters[0]->getName() === 'configuration' &&
                $typeName === 'array' &&
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
                $typeName = $parameter->getType();

                if ($typeName instanceof \ReflectionNamedType) {
                    $typeName = $typeName->getName();
                }

                $newProperty = [
                    'allowsNull' => $parameter->allowsNull(),
                    'defaultValue' => null,
                    'type' => $typeName,
                ];

                if ($parameter->isDefaultValueAvailable()) {
                    $newProperty['defaultValue'] = $parameter->getDefaultValue();
                }

                $newPropertyName = $parameter->getName();
                $newPropertyValue = $newProperty['defaultValue'];

                if (count($arguments) !== 0) {
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

    /**
     * Mutates the configured state of a property. Applies checks on type, nullability and other safety measures.
     *
     * @param string $propertyName The name of the property being mutated.
     * @param mixed $propertyValue The new value for the property.
     *
     * @throws ConfigurationException When an incompatible property value type is used.
     */
    private function changeState(
        string $propertyName,
        $propertyValue
    ): void {
        if ($this->configurationImmutable) {
            throw \Auth0\SDK\Exception\ConfigurationException::setImmutable();
        }

        if (! isset($this->configuredState[$propertyName])) {
            throw \Auth0\SDK\Exception\ConfigurationException::setMissing($propertyName);
        }

        $propertyType = gettype($propertyValue);

        $normalizedPropertyTypes = [
            'boolean' => 'bool',
            'integer' => 'int',
        ];

        $propertyType = $normalizedPropertyTypes[$propertyType] ?? $propertyType;

        $allowedTypes = [$this->configuredState[$propertyName]->type];
        $expectedType = $this->configuredState[$propertyName]->type;

        if ($this->configuredState[$propertyName]->allowsNull) {
            $allowedTypes[] = 'NULL';
        }

        if (! in_array($propertyType, $allowedTypes, true)) {
            if (! $propertyValue instanceof $expectedType) {
                if ($this->configuredState[$propertyName]->allowsNull) {
                    throw \Auth0\SDK\Exception\ConfigurationException::setIncompatibleNullable($propertyName, $expectedType, $propertyType);
                }

                throw \Auth0\SDK\Exception\ConfigurationException::setIncompatible($propertyName, $expectedType, $propertyType);
            }
        }

        if (method_exists($this, 'onStateChange')) {
            $propertyValue = $this->onStateChange($propertyName, $propertyValue);
        }

        $this->configuredState[$propertyName]->value = $propertyValue;
    }
}
