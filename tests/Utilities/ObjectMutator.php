<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

class ObjectMutator
{
    public static function getProperty(
        object|string $class,
        string $property
    ): mixed {
        $reflection = new \ReflectionObject($class);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($class);
    }

    public static function callMethod(
        object|string $class,
        string $method,
        array $args = []
    ): mixed {
        $reflection = new \ReflectionObject($class);
        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($class, $args);
    }
}
