<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use const E_USER_DEPRECATED;
use const FILTER_FLAG_IPV4;
use const FILTER_FLAG_IPV6;
use const FILTER_VALIDATE_IP;

use ArrayAccess;
use BadMethodCallException;
use Closure;
use Countable;
use DateTimeImmutable;
use Exception;
use InvalidArgumentException;
use ResourceBundle;
use SimpleXMLElement;
use Throwable;
use Traversable;

use function array_key_exists;
use function call_user_func_array;
use function count;
use function function_exists;
use function in_array;
use function is_array;
use function is_bool;
use function is_callable;
use function is_float;
use function is_int;
use function is_object;
use function is_resource;
use function is_scalar;
use function is_string;

/**
 * Utility class for assertions.
 *
 * @internal This class is not intended for use by SDK consumers. API changes may occur unpredictably.
 *
 * @codeCoverageIgnore
 */
final class Assert
{
    private function __construct()
    {
    }

    /**
     * @param mixed $name
     * @param mixed $arguments
     *
     * @throws BadMethodCallException
     */
    public static function __callStatic($name, $arguments): void
    {
        if ('nullOr' === mb_substr($name, 0, 6)) {
            if (null !== $arguments[0]) {
                $method = lcfirst(mb_substr($name, 6));
                call_user_func_array([self::class, $method], $arguments);
            }

            return;
        }

        if ('all' === mb_substr($name, 0, 3)) {
            self::isIterable($arguments[0]);

            $method = lcfirst(mb_substr($name, 3));
            $args = $arguments;

            foreach ($arguments[0] as $entry) {
                $args[0] = $entry;

                call_user_func_array([self::class, $method], $args);
            }

            return;
        }

        throw new BadMethodCallException('No such method: ' . $name);
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allAlnum($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::alnum($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allAlpha($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::alpha($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<bool> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allBoolean($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::boolean($entry, $message);
        }
    }

    /**
     * @psalm-assert iterable<class-string> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allClassExists($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::classExists($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $subString
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allContains($value, $subString, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::contains($entry, $subString, $message);
        }
    }

    /**
     * @param iterable<array|Countable> $array
     * @param int                       $number
     * @param string                    $message
     *
     * @throws InvalidArgumentException
     */
    public static function allCount($array, $number, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::count($entry, $number, $message);
        }
    }

    /**
     * @param iterable<array|Countable> $array
     * @param float|int                 $min
     * @param float|int                 $max
     * @param string                    $message
     *
     * @throws InvalidArgumentException
     */
    public static function allCountBetween($array, $min, $max, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::countBetween($entry, $min, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allDigits($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::digits($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allDirectory($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::directory($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allEmail($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::email($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $suffix
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allEndsWith($value, $suffix, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::endsWith($entry, $suffix, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allEq($value, $expect, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::eq($entry, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<false> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allFalse($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::false($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allFile($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::file($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allFileExists($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::fileExists($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<float> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allFloat($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::float($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allGreaterThan($value, $limit, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::greaterThan($entry, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allGreaterThanEq($value, $limit, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::greaterThanEq($entry, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $interface
     *
     * @psalm-assert iterable<class-string<ExpectedType>> $value
     *
     * @param mixed  $value
     * @param mixed  $interface
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allImplementsInterface($value, $interface, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::implementsInterface($entry, $interface, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allInArray($value, array $values, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::inArray($entry, $values, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<int> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allInteger($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::integer($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<numeric> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIntegerish($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::integerish($entry, $message);
        }
    }

    /**
     * @psalm-assert iterable<class-string> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allInterfaceExists($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::interfaceExists($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIp($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::ip($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIpv4($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::ipv4($entry, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIpv6($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::ipv6($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param array<class-string> $classes
     *
     * @param iterable<object|string> $value
     * @param string[]                $classes
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsAnyOf($value, array $classes, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isAnyOf($entry, $classes, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert iterable<ExpectedType|class-string<ExpectedType>> $value
     *
     * @param iterable<object|string> $value
     * @param string                  $class
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsAOf($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isAOf($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<array> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsArray($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isArray($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<array|ArrayAccess> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsArrayAccessible($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isArrayAccessible($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<callable> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsCallable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isCallable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<countable> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsCountable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isCountable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<empty> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsEmpty($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isEmpty($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert iterable<ExpectedType> $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsInstanceOf($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isInstanceOf($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param array<class-string> $classes
     *
     * @param mixed                $value
     * @param array<object|string> $classes
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsInstanceOfAny($value, array $classes, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isInstanceOfAny($entry, $classes, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<iterable> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsIterable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isIterable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<list> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsList($array, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::isList($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template T
     *
     * @psalm-param iterable<mixed|array<T>> $array
     *
     * @psalm-assert iterable<array<string, T>> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsMap($array, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::isMap($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<non-empty-list> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsNonEmptyList($array, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::isNonEmptyList($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template T
     *
     * @psalm-param iterable<mixed|array<T>> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsNonEmptyMap($array, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::isNonEmptyMap($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template UnexpectedType of object
     *
     * @psalm-param class-string<UnexpectedType> $class
     *
     * @param iterable<object|string> $value
     * @param string                  $class
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsNotA($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isNotA($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<iterable> $value
     *
     * @deprecated use "isIterable" or "isInstanceOf" instead
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allIsTraversable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::isTraversable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<array> $array
     * @param int|string      $key
     * @param string          $message
     *
     * @throws InvalidArgumentException
     */
    public static function allKeyExists($array, $key, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::keyExists($entry, $key, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<array> $array
     * @param int|string      $key
     * @param string          $message
     *
     * @throws InvalidArgumentException
     */
    public static function allKeyNotExists($array, $key, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::keyNotExists($entry, $key, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param int              $length
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allLength($value, $length, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::length($entry, $length, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param float|int        $min
     * @param float|int        $max
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allLengthBetween($value, $min, $max, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::lengthBetween($entry, $min, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allLessThan($value, $limit, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::lessThan($entry, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allLessThanEq($value, $limit, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::lessThanEq($entry, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<lowercase-string> $value
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allLower($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::lower($entry, $message);
        }
    }

    /**
     * @param iterable<array|Countable> $array
     * @param float|int                 $max
     * @param string                    $message
     *
     * @throws InvalidArgumentException
     */
    public static function allMaxCount($array, $max, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::maxCount($entry, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param float|int        $max
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allMaxLength($value, $max, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::maxLength($entry, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param iterable<class-string|object> $classOrObject
     *
     * @param iterable<object|string> $classOrObject
     * @param mixed                   $method
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     */
    public static function allMethodExists($classOrObject, $method, $message = ''): void
    {
        self::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            self::methodExists($entry, $method, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param iterable<class-string|object> $classOrObject
     *
     * @param iterable<object|string> $classOrObject
     * @param mixed                   $method
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     */
    public static function allMethodNotExists($classOrObject, $method, $message = ''): void
    {
        self::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            self::methodNotExists($entry, $method, $message);
        }
    }

    /**
     * @param iterable<array|Countable> $array
     * @param float|int                 $min
     * @param string                    $message
     *
     * @throws InvalidArgumentException
     */
    public static function allMinCount($array, $min, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            self::minCount($entry, $min, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param float|int        $min
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allMinLength($value, $min, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::minLength($entry, $min, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<positive-int|0> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNatural($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::natural($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $subString
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotContains($value, $subString, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notContains($entry, $subString, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotEmpty($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notEmpty($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $suffix
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotEndsWith($value, $suffix, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notEndsWith($entry, $suffix, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotEq($value, $expect, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notEq($entry, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotFalse($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notFalse($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotInstanceOf($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notInstanceOf($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotNull($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notNull($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $pattern
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotRegex($value, $pattern, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notRegex($entry, $pattern, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotSame($value, $expect, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notSame($entry, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $prefix
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotStartsWith($value, $prefix, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notStartsWith($entry, $prefix, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNotWhitespaceOnly($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::notWhitespaceOnly($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNull($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::null($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrAlnum($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::alnum($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrAlpha($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::alpha($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<bool|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrBoolean($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::boolean($entry, $message);
            }
        }
    }

    /**
     * @psalm-assert iterable<class-string|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrClassExists($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::classExists($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $subString
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrContains($value, $subString, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::contains($entry, $subString, $message);
            }
        }
    }

    /**
     * @param iterable<null|array|Countable> $array
     * @param int                            $number
     * @param string                         $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrCount($array, $number, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::count($entry, $number, $message);
            }
        }
    }

    /**
     * @param iterable<null|array|Countable> $array
     * @param float|int                      $min
     * @param float|int                      $max
     * @param string                         $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrCountBetween($array, $min, $max, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::countBetween($entry, $min, $max, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrDigits($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::digits($entry, $message);
            }
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrDirectory($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::directory($entry, $message);
            }
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrEmail($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::email($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $suffix
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrEndsWith($value, $suffix, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::endsWith($entry, $suffix, $message);
            }
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrEq($value, $expect, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::eq($entry, $expect, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<false|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrFalse($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::false($entry, $message);
            }
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrFile($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::file($entry, $message);
            }
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrFileExists($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::fileExists($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<float|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrFloat($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::float($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrGreaterThan($value, $limit, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::greaterThan($entry, $limit, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrGreaterThanEq($value, $limit, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::greaterThanEq($entry, $limit, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $interface
     *
     * @psalm-assert iterable<class-string<ExpectedType>|null> $value
     *
     * @param mixed  $value
     * @param mixed  $interface
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrImplementsInterface($value, $interface, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::implementsInterface($entry, $interface, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrInArray($value, array $values, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::inArray($entry, $values, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<int|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrInteger($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::integer($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<numeric|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIntegerish($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::integerish($entry, $message);
            }
        }
    }

    /**
     * @psalm-assert iterable<class-string|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrInterfaceExists($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::interfaceExists($entry, $message);
            }
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIp($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::ip($entry, $message);
            }
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIpv4($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::ipv4($entry, $message);
            }
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIpv6($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::ipv6($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param array<class-string> $classes
     *
     * @param iterable<null|object|string> $value
     * @param string[]                     $classes
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsAnyOf($value, array $classes, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isAnyOf($entry, $classes, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert iterable<ExpectedType|class-string<ExpectedType>|null> $value
     *
     * @param iterable<null|object|string> $value
     * @param string                       $class
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsAOf($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isAOf($entry, $class, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<array|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsArray($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isArray($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<array|ArrayAccess|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsArrayAccessible($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isArrayAccessible($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<callable|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsCallable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isCallable($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<countable|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsCountable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isCountable($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<empty|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsEmpty($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isEmpty($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert iterable<ExpectedType|null> $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsInstanceOf($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isInstanceOf($entry, $class, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param array<class-string> $classes
     *
     * @param mixed                $value
     * @param array<object|string> $classes
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsInstanceOfAny($value, array $classes, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isInstanceOfAny($entry, $classes, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<iterable|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsIterable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isIterable($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<list|null> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsList($array, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::isList($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template T
     *
     * @psalm-param iterable<mixed|array<T>|null> $array
     *
     * @psalm-assert iterable<array<string, T>|null> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsMap($array, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::isMap($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<non-empty-list|null> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsNonEmptyList($array, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::isNonEmptyList($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template T
     *
     * @psalm-param iterable<mixed|array<T>|null> $array
     *
     * @psalm-assert iterable<array<string, T>|null> $array
     * @psalm-assert iterable<!empty|null> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsNonEmptyMap($array, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::isNonEmptyMap($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template UnexpectedType of object
     *
     * @psalm-param class-string<UnexpectedType> $class
     *
     * @psalm-assert iterable<!UnexpectedType|null> $value
     * @psalm-assert iterable<!class-string<UnexpectedType>|null> $value
     *
     * @param iterable<null|object|string> $value
     * @param string                       $class
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsNotA($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isNotA($entry, $class, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<iterable|null> $value
     *
     * @deprecated use "isIterable" or "isInstanceOf" instead
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrIsTraversable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::isTraversable($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|array> $array
     * @param int|string           $key
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrKeyExists($array, $key, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::keyExists($entry, $key, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|array> $array
     * @param int|string           $key
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrKeyNotExists($array, $key, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::keyNotExists($entry, $key, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param int                   $length
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrLength($value, $length, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::length($entry, $length, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param float|int             $min
     * @param float|int             $max
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrLengthBetween($value, $min, $max, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::lengthBetween($entry, $min, $max, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrLessThan($value, $limit, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::lessThan($entry, $limit, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrLessThanEq($value, $limit, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::lessThanEq($entry, $limit, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<lowercase-string|null> $value
     *
     * @param iterable<null|string> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrLower($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::lower($entry, $message);
            }
        }
    }

    /**
     * @param iterable<null|array|Countable> $array
     * @param float|int                      $max
     * @param string                         $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrMaxCount($array, $max, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::maxCount($entry, $max, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param float|int             $max
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrMaxLength($value, $max, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::maxLength($entry, $max, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param iterable<class-string|object|null> $classOrObject
     *
     * @param iterable<null|object|string> $classOrObject
     * @param mixed                        $method
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrMethodExists($classOrObject, $method, $message = ''): void
    {
        self::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            if (null !== $entry) {
                self::methodExists($entry, $method, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param iterable<class-string|object|null> $classOrObject
     *
     * @param iterable<null|object|string> $classOrObject
     * @param mixed                        $method
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrMethodNotExists($classOrObject, $method, $message = ''): void
    {
        self::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            if (null !== $entry) {
                self::methodNotExists($entry, $method, $message);
            }
        }
    }

    /**
     * @param iterable<null|array|Countable> $array
     * @param float|int                      $min
     * @param string                         $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrMinCount($array, $min, $message = ''): void
    {
        self::isIterable($array);

        foreach ($array as $entry) {
            if (null !== $entry) {
                self::minCount($entry, $min, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param float|int             $min
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrMinLength($value, $min, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::minLength($entry, $min, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<positive-int|0|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNatural($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::natural($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $subString
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotContains($value, $subString, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notContains($entry, $subString, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<!empty|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotEmpty($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notEmpty($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $suffix
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotEndsWith($value, $suffix, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notEndsWith($entry, $suffix, $message);
            }
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotEq($value, $expect, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notEq($entry, $expect, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<!false|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotFalse($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notFalse($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert iterable<!ExpectedType|null> $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotInstanceOf($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notInstanceOf($entry, $class, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $pattern
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotRegex($value, $pattern, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notRegex($entry, $pattern, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotSame($value, $expect, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notSame($entry, $expect, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $prefix
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotStartsWith($value, $prefix, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notStartsWith($entry, $prefix, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNotWhitespaceOnly($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::notWhitespaceOnly($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<numeric|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrNumeric($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::numeric($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<object|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrObject($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::object($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrOneOf($value, array $values, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::oneOf($entry, $values, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<positive-int|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrPositiveInteger($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::positiveInteger($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param iterable<class-string|object|null> $classOrObject
     *
     * @param iterable<null|object|string> $classOrObject
     * @param mixed                        $property
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrPropertyExists($classOrObject, $property, $message = ''): void
    {
        self::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            if (null !== $entry) {
                self::propertyExists($entry, $property, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param iterable<class-string|object|null> $classOrObject
     *
     * @param iterable<null|object|string> $classOrObject
     * @param mixed                        $property
     * @param string                       $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrPropertyNotExists($classOrObject, $property, $message = ''): void
    {
        self::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            if (null !== $entry) {
                self::propertyNotExists($entry, $property, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $min
     * @param mixed  $max
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrRange($value, $min, $max, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::range($entry, $min, $max, $message);
            }
        }
    }

    /**
     * @param iterable<null|string> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrReadable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::readable($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $pattern
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrRegex($value, $pattern, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::regex($entry, $pattern, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<resource|null> $value
     *
     * @param mixed       $value
     * @param null|string $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrResource($value, $type = null, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::resource($entry, $type, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrSame($value, $expect, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::same($entry, $expect, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<scalar|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrScalar($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::scalar($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $prefix
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrStartsWith($value, $prefix, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::startsWith($entry, $prefix, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrStartsWithLetter($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::startsWithLetter($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<string|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrString($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::string($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<non-empty-string|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrStringNotEmpty($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::stringNotEmpty($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert iterable<class-string<ExpectedType>|ExpectedType|null> $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrSubclassOf($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::subclassOf($entry, $class, $message);
            }
        }
    }

    /**
     * @psalm-param class-string<Throwable> $class
     *
     * @param iterable<null|Closure> $expression
     * @param string                 $class
     * @param string                 $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrThrows($expression, $class = 'Exception', $message = ''): void
    {
        self::isIterable($expression);

        foreach ($expression as $entry) {
            if ($entry instanceof Closure) {
                self::throws($entry, $class, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<true|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrTrue($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::true($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrUnicodeLetters($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::unicodeLetters($entry, $message);
            }
        }
    }

    /**
     * @param iterable<null|array> $values
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrUniqueValues($values, $message = ''): void
    {
        self::isIterable($values);

        foreach ($values as $value) {
            if (null !== $value) {
                self::uniqueValues($value, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<!lowercase-string|null> $value
     *
     * @param iterable<null|string> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrUpper($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::upper($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<null|string> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrUuid($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::uuid($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<array-key|null> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrValidArrayKey($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::validArrayKey($entry, $message);
            }
        }
    }

    /**
     * @param iterable<null|string> $value
     * @param string                $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNullOrWritable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            if (null !== $entry) {
                self::writable($entry, $message);
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<numeric> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allNumeric($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::numeric($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<object> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allObject($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::object($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allOneOf($value, array $values, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::oneOf($entry, $values, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<positive-int> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allPositiveInteger($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::positiveInteger($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param iterable<class-string|object> $classOrObject
     *
     * @param iterable<object|string> $classOrObject
     * @param mixed                   $property
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     */
    public static function allPropertyExists($classOrObject, $property, $message = ''): void
    {
        self::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            self::propertyExists($entry, $property, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param iterable<class-string|object> $classOrObject
     *
     * @param iterable<object|string> $classOrObject
     * @param mixed                   $property
     * @param string                  $message
     *
     * @throws InvalidArgumentException
     */
    public static function allPropertyNotExists($classOrObject, $property, $message = ''): void
    {
        self::isIterable($classOrObject);

        foreach ($classOrObject as $entry) {
            self::propertyNotExists($entry, $property, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $min
     * @param mixed  $max
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allRange($value, $min, $max, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::range($entry, $min, $max, $message);
        }
    }

    /**
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allReadable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::readable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $pattern
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allRegex($value, $pattern, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::regex($entry, $pattern, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<resource> $value
     *
     * @param mixed       $value
     * @param null|string $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function allResource($value, $type = null, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::resource($entry, $type, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allSame($value, $expect, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::same($entry, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<scalar> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allScalar($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::scalar($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $prefix
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allStartsWith($value, $prefix, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::startsWith($entry, $prefix, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allStartsWithLetter($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::startsWithLetter($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<string> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allString($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::string($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<non-empty-string> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allStringNotEmpty($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::stringNotEmpty($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert iterable<class-string<ExpectedType>|ExpectedType> $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function allSubclassOf($value, $class, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::subclassOf($entry, $class, $message);
        }
    }

    /**
     * @psalm-param class-string<Throwable> $class
     *
     * @param iterable<Closure> $expression
     * @param string            $class
     * @param string            $message
     *
     * @throws InvalidArgumentException
     */
    public static function allThrows($expression, $class = 'Exception', $message = ''): void
    {
        self::isIterable($expression);

        foreach ($expression as $entry) {
            self::throws($entry, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<true> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allTrue($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::true($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allUnicodeLetters($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::unicodeLetters($entry, $message);
        }
    }

    /**
     * @param iterable<array> $values
     * @param string          $message
     *
     * @throws InvalidArgumentException
     */
    public static function allUniqueValues($values, $message = ''): void
    {
        self::isIterable($values);

        foreach ($values as $value) {
            self::uniqueValues($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allUpper($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::upper($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allUuid($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::uuid($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable<array-key> $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function allValidArrayKey($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::validArrayKey($entry, $message);
        }
    }

    /**
     * @param iterable<string> $value
     * @param string           $message
     *
     * @throws InvalidArgumentException
     */
    public static function allWritable($value, $message = ''): void
    {
        self::isIterable($value);

        foreach ($value as $entry) {
            self::writable($entry, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function alnum($value, $message = ''): void
    {
        $locale = setlocale(LC_CTYPE, 0);
        setlocale(LC_CTYPE, 'C');
        $valid = ! ctype_alnum($value);
        setlocale(LC_CTYPE, $locale);

        if ($valid) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain letters and digits only. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function alpha($value, $message = ''): void
    {
        self::string($value);

        $locale = setlocale(LC_CTYPE, 0);
        setlocale(LC_CTYPE, 'C');
        $valid = ! ctype_alpha($value);
        setlocale(LC_CTYPE, $locale);

        if ($valid) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain only letters. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert bool $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function boolean($value, $message = ''): void
    {
        if (! is_bool($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a boolean. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-assert class-string $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function classExists($value, $message = ''): void
    {
        if (! class_exists($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an existing class name. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $subString
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function contains($value, $subString, $message = ''): void
    {
        if (! str_contains($value, $subString)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($subString),
            ));
        }
    }

    /**
     * Does not check if $array is countable, this can generate a warning on php versions after 7.2.
     *
     * @param array|Countable $array
     * @param int             $number
     * @param string          $message
     *
     * @throws InvalidArgumentException
     */
    public static function count($array, $number, $message = ''): void
    {
        self::eq(
            count($array),
            $number,
            sprintf(
                $message ?: 'Expected an array to contain %d elements. Got: %d.',
                $number,
                count($array),
            ),
        );
    }

    /**
     * Does not check if $array is countable, this can generate a warning on php versions after 7.2.
     *
     * @param array|Countable $array
     * @param float|int       $min
     * @param float|int       $max
     * @param string          $message
     *
     * @throws InvalidArgumentException
     */
    public static function countBetween($array, $min, $max, $message = ''): void
    {
        $count = count($array);

        if ($count < $min || $count > $max) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an array to contain between %2$d and %3$d elements. Got: %d',
                $count,
                $min,
                $max,
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function digits($value, $message = ''): void
    {
        $locale = setlocale(LC_CTYPE, 0);
        setlocale(LC_CTYPE, 'C');
        $valid = ! ctype_digit($value);
        setlocale(LC_CTYPE, $locale);

        if ($valid) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain digits only. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function directory($value, $message = ''): void
    {
        self::fileExists($value, $message);

        if (! is_dir($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'The path %s is no directory.',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function email($value, $message = ''): void
    {
        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to be a valid e-mail address. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $suffix
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function endsWith($value, $suffix, $message = ''): void
    {
        if ($suffix !== mb_substr($value, -mb_strlen($suffix))) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to end with %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($suffix),
            ));
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function eq($value, $expect, $message = ''): void
    {
        if ($expect !== $value) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value equal to %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($expect),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert false $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function false($value, $message = ''): void
    {
        if (false !== $value) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to be false. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function file($value, $message = ''): void
    {
        self::fileExists($value, $message);

        if (! is_file($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'The path %s is not a file.',
                self::valueToString($value),
            ));
        }
    }

    /**
     * Will also pass if $value is a directory, use Assert::file() instead if you need to be sure it is a file.
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function fileExists($value, $message = ''): void
    {
        self::string($value);

        if (! file_exists($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'The file %s does not exist.',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert float $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function float($value, $message = ''): void
    {
        if (! is_float($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a float. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function greaterThan($value, $limit, $message = ''): void
    {
        if ($value <= $limit) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value greater than %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($limit),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function greaterThanEq($value, $limit, $message = ''): void
    {
        if ($value < $limit) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value greater than or equal to %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($limit),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $interface
     *
     * @psalm-assert class-string<ExpectedType> $value
     *
     * @param mixed  $value
     * @param mixed  $interface
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function implementsInterface($value, $interface, $message = ''): void
    {
        if (! in_array($interface, class_implements($value), true)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an implementation of %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($interface),
            ));
        }
    }

    /**
     * Does strict comparison, so Assert::inArray(3, ['3']) does not pass the assertion.
     *
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function inArray($value, array $values, $message = ''): void
    {
        if (! in_array($value, $values, true)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected one of: %2$s. Got: %s',
                self::valueToString($value),
                implode(', ', array_map(static fn ($value): string => self::valueToString($value), $values)),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert int $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function integer($value, $message = ''): void
    {
        if (! is_int($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an integer. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert numeric $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function integerish($value, $message = ''): void
    {
        if (! is_numeric($value) || $value !== (int) $value) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an integerish value. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-assert class-string $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function interfaceExists($value, $message = ''): void
    {
        if (! interface_exists($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an existing interface name. got %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function ip($value, $message = ''): void
    {
        if (false === filter_var($value, FILTER_VALIDATE_IP)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to be an IP. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function ipv4($value, $message = ''): void
    {
        if (false === filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to be an IPv4. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function ipv6($value, $message = ''): void
    {
        if (false === filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to be an IPv6. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param array<class-string> $classes
     *
     * @param object|string $value
     * @param string[]      $classes
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function isAnyOf($value, array $classes, $message = ''): void
    {
        foreach ($classes as $class) {
            self::string($class, 'Expected class as a string. Got: %s');

            if (is_a($value, $class, is_string($value))) {
                return;
            }
        }

        self::reportInvalidArgument(sprintf(
            $message ?: 'Expected an instance of any of this classes or any of those classes among their parents "%2$s". Got: %s',
            self::valueToString($value),
            implode(', ', $classes),
        ));
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert ExpectedType|class-string<ExpectedType> $value
     *
     * @param object|string $value
     * @param string        $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function isAOf($value, $class, $message = ''): void
    {
        self::string($class, 'Expected class as a string. Got: %s');

        if (! is_a($value, $class, is_string($value))) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an instance of this class or to this class among its parents "%2$s". Got: %s',
                self::valueToString($value),
                $class,
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert array $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isArray($value, $message = ''): void
    {
        if (! is_array($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an array. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert array|ArrayAccess $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isArrayAccessible($value, $message = ''): void
    {
        if (! is_array($value) && ! ($value instanceof ArrayAccess)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an array accessible. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert callable $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isCallable($value, $message = ''): void
    {
        if (! is_callable($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a callable. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert countable $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isCountable($value, $message = ''): void
    {
        if (
            ! is_array($value)
            && ! ($value instanceof Countable)
            && ! ($value instanceof ResourceBundle)
            && ! ($value instanceof SimpleXMLElement)
        ) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a countable. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert empty $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isEmpty($value, $message = ''): void
    {
        if (! empty($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an empty value. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert ExpectedType $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function isInstanceOf($value, $class, $message = ''): void
    {
        if (! ($value instanceof $class)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an instance of %2$s. Got: %s',
                self::typeToString($value),
                $class,
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param array<class-string> $classes
     *
     * @param mixed                $value
     * @param array<object|string> $classes
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function isInstanceOfAny($value, array $classes, $message = ''): void
    {
        foreach ($classes as $class) {
            if ($value instanceof $class) {
                return;
            }
        }

        self::reportInvalidArgument(sprintf(
            $message ?: 'Expected an instance of any of %2$s. Got: %s',
            self::typeToString($value),
            implode(', ', array_map(static fn ($value): string => self::valueToString($value), $classes)),
        ));
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isIterable($value, $message = ''): void
    {
        if (! is_array($value) && ! ($value instanceof Traversable)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an iterable. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert list $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isList($array, $message = ''): void
    {
        if (! is_array($array)) {
            self::reportInvalidArgument(
                $message ?: 'Expected list - non-associative array.',
            );
        }

        if ($array === array_values($array)) {
            return;
        }

        $nextKey = -1;
        foreach (array_keys($array) as $k) {
            if ($k !== ++$nextKey) {
                self::reportInvalidArgument(
                    $message ?: 'Expected list - non-associative array.',
                );
            }
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template T
     *
     * @psalm-param mixed|array<T> $array
     *
     * @psalm-assert array<string, T> $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isMap($array, $message = ''): void
    {
        if (
            ! is_array($array)
            || array_keys($array) !== array_filter(array_keys($array), '\is_string')
        ) {
            self::reportInvalidArgument(
                $message ?: 'Expected map - associative array with string keys.',
            );
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert non-empty-list $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isNonEmptyList($array, $message = ''): void
    {
        self::isList($array, $message);
        self::notEmpty($array, $message);
    }

    /**
     * @psalm-pure
     *
     * @psalm-template T
     *
     * @psalm-param mixed|array<T> $array
     *
     * @psalm-assert array<string, T> $array
     * @psalm-assert !empty $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isNonEmptyMap($array, $message = ''): void
    {
        self::isMap($array, $message);
        self::notEmpty($array, $message);
    }

    /**
     * @psalm-pure
     *
     * @psalm-template UnexpectedType of object
     *
     * @psalm-param class-string<UnexpectedType> $class
     *
     * @psalm-assert !UnexpectedType $value
     * @psalm-assert !class-string<UnexpectedType> $value
     *
     * @param object|string $value
     * @param string        $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function isNotA($value, $class, $message = ''): void
    {
        self::string($class, 'Expected class as a string. Got: %s');

        if (is_a($value, $class, is_string($value))) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an instance of this class or to this class among its parents other than "%2$s". Got: %s',
                self::valueToString($value),
                $class,
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable $value
     *
     * @deprecated use "isIterable" or "isInstanceOf" instead
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function isTraversable($value, $message = ''): void
    {
        @trigger_error(
            sprintf(
                'The "%s" assertion is deprecated. You should stop using it, as it will soon be removed in 2.0 version. Use "isIterable" or "isInstanceOf" instead.',
                __METHOD__,
            ),
            E_USER_DEPRECATED,
        );

        if (! is_array($value) && ! ($value instanceof Traversable)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a traversable. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param array      $array
     * @param int|string $key
     * @param string     $message
     *
     * @throws InvalidArgumentException
     */
    public static function keyExists($array, $key, $message = ''): void
    {
        if (! isset($array[$key]) && ! array_key_exists($key, $array)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected the key %s to exist.',
                self::valueToString($key),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param array      $array
     * @param int|string $key
     * @param string     $message
     *
     * @throws InvalidArgumentException
     */
    public static function keyNotExists($array, $key, $message = ''): void
    {
        if (isset($array[$key]) || array_key_exists($key, $array)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected the key %s to not exist.',
                self::valueToString($key),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param int    $length
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function length($value, $length, $message = ''): void
    {
        if ($length !== self::strlen($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain %2$s characters. Got: %s',
                self::valueToString($value),
                $length,
            ));
        }
    }

    /**
     * Inclusive , so Assert::lengthBetween('asd', 3, 5); passes the assertion.
     *
     * @psalm-pure
     *
     * @param string    $value
     * @param float|int $min
     * @param float|int $max
     * @param string    $message
     *
     * @throws InvalidArgumentException
     */
    public static function lengthBetween($value, $min, $max, $message = ''): void
    {
        $length = self::strlen($value);

        if ($length < $min || $length > $max) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain between %2$s and %3$s characters. Got: %s',
                self::valueToString($value),
                $min,
                $max,
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function lessThan($value, $limit, $message = ''): void
    {
        if ($value >= $limit) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value less than %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($limit),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function lessThanEq($value, $limit, $message = ''): void
    {
        if ($value > $limit) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value less than or equal to %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($limit),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert lowercase-string $value
     *
     * @param string $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function lower($value, $message = ''): void
    {
        $locale = setlocale(LC_CTYPE, 0);
        setlocale(LC_CTYPE, 'C');
        $valid = ! ctype_lower($value);
        setlocale(LC_CTYPE, $locale);

        if ($valid) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain lowercase characters only. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * Does not check if $array is countable, this can generate a warning on php versions after 7.2.
     *
     * @param array|Countable $array
     * @param float|int       $max
     * @param string          $message
     *
     * @throws InvalidArgumentException
     */
    public static function maxCount($array, $max, $message = ''): void
    {
        if (count($array) > $max) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an array to contain at most %2$d elements. Got: %d',
                count($array),
                $max,
            ));
        }
    }

    /**
     * Inclusive max.
     *
     * @psalm-pure
     *
     * @param string    $value
     * @param float|int $max
     * @param string    $message
     *
     * @throws InvalidArgumentException
     */
    public static function maxLength($value, $max, $message = ''): void
    {
        if (self::strlen($value) > $max) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain at most %2$s characters. Got: %s',
                self::valueToString($value),
                $max,
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param class-string|object $classOrObject
     *
     * @param object|string $classOrObject
     * @param mixed         $method
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function methodExists($classOrObject, $method, $message = ''): void
    {
        if (! is_string($classOrObject) && ! is_object($classOrObject) || ! method_exists($classOrObject, $method)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected the method %s to exist.',
                self::valueToString($method),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param class-string|object $classOrObject
     *
     * @param object|string $classOrObject
     * @param mixed         $method
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function methodNotExists($classOrObject, $method, $message = ''): void
    {
        if ((is_string($classOrObject) || is_object($classOrObject)) && method_exists($classOrObject, $method)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected the method %s to not exist.',
                self::valueToString($method),
            ));
        }
    }

    /**
     * Does not check if $array is countable, this can generate a warning on php versions after 7.2.
     *
     * @param array|Countable $array
     * @param float|int       $min
     * @param string          $message
     *
     * @throws InvalidArgumentException
     */
    public static function minCount($array, $min, $message = ''): void
    {
        if (count($array) < $min) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an array to contain at least %2$d elements. Got: %d',
                count($array),
                $min,
            ));
        }
    }

    /**
     * Inclusive min.
     *
     * @psalm-pure
     *
     * @param string    $value
     * @param float|int $min
     * @param string    $message
     *
     * @throws InvalidArgumentException
     */
    public static function minLength($value, $min, $message = ''): void
    {
        if (self::strlen($value) < $min) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain at least %2$s characters. Got: %s',
                self::valueToString($value),
                $min,
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert positive-int|0 $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function natural($value, $message = ''): void
    {
        if (! is_int($value) || $value < 0) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a non-negative integer. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $subString
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notContains($value, $subString, $message = ''): void
    {
        if (str_contains($value, $subString)) {
            self::reportInvalidArgument(sprintf(
                $message ?: '%2$s was not expected to be contained in a value. Got: %s',
                self::valueToString($value),
                self::valueToString($subString),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert !empty $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notEmpty($value, $message = ''): void
    {
        if (empty($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a non-empty value. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $suffix
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notEndsWith($value, $suffix, $message = ''): void
    {
        if ($suffix === mb_substr($value, -mb_strlen($suffix))) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value not to end with %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($suffix),
            ));
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notEq($value, $expect, $message = ''): void
    {
        if ($expect === $value) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a different value than %s.',
                self::valueToString($expect),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert !false $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notFalse($value, $message = ''): void
    {
        if (false === $value) {
            self::reportInvalidArgument(
                $message ?: 'Expected a value other than false.',
            );
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert !ExpectedType $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function notInstanceOf($value, $class, $message = ''): void
    {
        if ($value instanceof $class) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an instance other than %2$s. Got: %s',
                self::typeToString($value),
                $class,
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert !null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notNull($value, $message = ''): void
    {
        if (null === $value) {
            self::reportInvalidArgument(
                $message ?: 'Expected a value other than null.',
            );
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $pattern
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notRegex($value, $pattern, $message = ''): void
    {
        if (preg_match($pattern, $value, $matches, PREG_OFFSET_CAPTURE)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'The value %s matches the pattern %s (at offset %d).',
                self::valueToString($value),
                self::valueToString($pattern),
                $matches[0][1],
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notSame($value, $expect, $message = ''): void
    {
        if ($expect === $value) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value not identical to %s.',
                self::valueToString($expect),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $prefix
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notStartsWith($value, $prefix, $message = ''): void
    {
        if (str_starts_with($value, $prefix)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value not to start with %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($prefix),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function notWhitespaceOnly($value, $message = ''): void
    {
        if (preg_match('#^\s*$#', $value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a non-whitespace string. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function null($value, $message = ''): void
    {
        if (null !== $value) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected null. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrAlnum($value, $message = ''): void
    {
        if (null !== $value) {
            self::alnum($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrAlpha($value, $message = ''): void
    {
        if (null !== $value) {
            self::alpha($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert bool|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrBoolean($value, $message = ''): void
    {
        if (null !== $value) {
            self::boolean($value, $message);
        }
    }

    /**
     * @psalm-assert class-string|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrClassExists($value, $message = ''): void
    {
        if (null !== $value) {
            self::classExists($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $subString
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrContains($value, $subString, $message = ''): void
    {
        if (null !== $value) {
            self::contains($value, $subString, $message);
        }
    }

    /**
     * @param null|array|Countable $array
     * @param int                  $number
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrCount($array, $number, $message = ''): void
    {
        if (null !== $array) {
            self::count($array, $number, $message);
        }
    }

    /**
     * @param null|array|Countable $array
     * @param float|int            $min
     * @param float|int            $max
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrCountBetween($array, $min, $max, $message = ''): void
    {
        if (null !== $array) {
            self::countBetween($array, $min, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrDigits($value, $message = ''): void
    {
        if (null !== $value) {
            self::digits($value, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrDirectory($value, $message = ''): void
    {
        if (null !== $value) {
            self::directory($value, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrEmail($value, $message = ''): void
    {
        if (null !== $value) {
            self::email($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $suffix
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrEndsWith($value, $suffix, $message = ''): void
    {
        if (null !== $value) {
            self::endsWith($value, $suffix, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrEq($value, $expect, $message = ''): void
    {
        if (null !== $value) {
            self::eq($value, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert false|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrFalse($value, $message = ''): void
    {
        if (null !== $value) {
            self::false($value, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrFile($value, $message = ''): void
    {
        if (null !== $value) {
            self::file($value, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrFileExists($value, $message = ''): void
    {
        if (null !== $value) {
            self::fileExists($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert float|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrFloat($value, $message = ''): void
    {
        if (null !== $value) {
            self::float($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrGreaterThan($value, $limit, $message = ''): void
    {
        if (null !== $value) {
            self::greaterThan($value, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrGreaterThanEq($value, $limit, $message = ''): void
    {
        if (null !== $value) {
            self::greaterThanEq($value, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $interface
     *
     * @psalm-assert class-string<ExpectedType>|null $value
     *
     * @param mixed  $value
     * @param mixed  $interface
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrImplementsInterface($value, $interface, $message = ''): void
    {
        if (null !== $value) {
            self::implementsInterface($value, $interface, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrInArray($value, array $values, $message = ''): void
    {
        if (null !== $value) {
            self::inArray($value, $values, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert int|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrInteger($value, $message = ''): void
    {
        if (null !== $value) {
            self::integer($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert numeric|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIntegerish($value, $message = ''): void
    {
        if (null !== $value) {
            self::integerish($value, $message);
        }
    }

    /**
     * @psalm-assert class-string|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrInterfaceExists($value, $message = ''): void
    {
        if (null !== $value) {
            self::interfaceExists($value, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIp($value, $message = ''): void
    {
        if (null !== $value) {
            self::ip($value, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIpv4($value, $message = ''): void
    {
        if (null !== $value) {
            self::ipv4($value, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIpv6($value, $message = ''): void
    {
        if (null !== $value) {
            self::ipv6($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param array<class-string> $classes
     *
     * @param null|object|string $value
     * @param string[]           $classes
     * @param string             $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsAnyOf($value, array $classes, $message = ''): void
    {
        if (null !== $value) {
            self::isAnyOf($value, $classes, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert ExpectedType|class-string<ExpectedType>|null $value
     *
     * @param null|object|string $value
     * @param string             $class
     * @param string             $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsAOf($value, $class, $message = ''): void
    {
        if (null !== $value) {
            self::isAOf($value, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert array|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsArray($value, $message = ''): void
    {
        if (null !== $value) {
            self::isArray($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert array|ArrayAccess|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsArrayAccessible($value, $message = ''): void
    {
        if (null !== $value) {
            self::isArrayAccessible($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert callable|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsCallable($value, $message = ''): void
    {
        if (null !== $value) {
            self::isCallable($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert countable|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsCountable($value, $message = ''): void
    {
        if (null !== $value) {
            self::isCountable($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert empty $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsEmpty($value, $message = ''): void
    {
        if (null !== $value) {
            self::isEmpty($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert ExpectedType|null $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsInstanceOf($value, $class, $message = ''): void
    {
        if (null !== $value) {
            self::isInstanceOf($value, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param array<class-string> $classes
     *
     * @param mixed                $value
     * @param array<object|string> $classes
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsInstanceOfAny($value, array $classes, $message = ''): void
    {
        if (null !== $value) {
            self::isInstanceOfAny($value, $classes, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsIterable($value, $message = ''): void
    {
        if (null !== $value) {
            self::isIterable($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert list|null $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsList($array, $message = ''): void
    {
        if (null !== $array) {
            self::isList($array, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template T
     *
     * @psalm-param mixed|array<T>|null $array
     *
     * @psalm-assert array<string, T>|null $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsMap($array, $message = ''): void
    {
        if (null !== $array) {
            self::isMap($array, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert non-empty-list|null $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsNonEmptyList($array, $message = ''): void
    {
        if (null !== $array) {
            self::isNonEmptyList($array, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template T
     *
     * @psalm-param mixed|array<T>|null $array
     *
     * @param mixed  $array
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsNonEmptyMap($array, $message = ''): void
    {
        if (null !== $array) {
            self::isNonEmptyMap($array, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template UnexpectedType of object
     *
     * @psalm-param class-string<UnexpectedType> $class
     *
     * @param null|object|string $value
     * @param string             $class
     * @param string             $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsNotA($value, $class, $message = ''): void
    {
        if (null !== $value) {
            self::isNotA($value, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert iterable|null $value
     *
     * @deprecated use "isIterable" or "isInstanceOf" instead
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrIsTraversable($value, $message = ''): void
    {
        if (null !== $value) {
            self::isTraversable($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|array $array
     * @param int|string $key
     * @param string     $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrKeyExists($array, $key, $message = ''): void
    {
        if (null !== $array) {
            self::keyExists($array, $key, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|array $array
     * @param int|string $key
     * @param string     $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrKeyNotExists($array, $key, $message = ''): void
    {
        if (null !== $array) {
            self::keyNotExists($array, $key, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param int         $length
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrLength($value, $length, $message = ''): void
    {
        if (null !== $value) {
            self::length($value, $length, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param float|int   $min
     * @param float|int   $max
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrLengthBetween($value, $min, $max, $message = ''): void
    {
        if (null !== $value) {
            self::lengthBetween($value, $min, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrLessThan($value, $limit, $message = ''): void
    {
        if (null !== $value) {
            self::lessThan($value, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $limit
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrLessThanEq($value, $limit, $message = ''): void
    {
        if (null !== $value) {
            self::lessThanEq($value, $limit, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert lowercase-string|null $value
     *
     * @param null|string $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrLower($value, $message = ''): void
    {
        if (null !== $value) {
            self::lower($value, $message);
        }
    }

    /**
     * @param null|array|Countable $array
     * @param float|int            $max
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrMaxCount($array, $max, $message = ''): void
    {
        if (null !== $array) {
            self::maxCount($array, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param float|int   $max
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrMaxLength($value, $max, $message = ''): void
    {
        if (null !== $value) {
            self::maxLength($value, $max, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param class-string|object|null $classOrObject
     *
     * @param null|object|string $classOrObject
     * @param mixed              $method
     * @param string             $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrMethodExists($classOrObject, $method, $message = ''): void
    {
        if (null !== $classOrObject) {
            self::methodExists($classOrObject, $method, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param class-string|object|null $classOrObject
     *
     * @param null|object|string $classOrObject
     * @param mixed              $method
     * @param string             $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrMethodNotExists($classOrObject, $method, $message = ''): void
    {
        if (null !== $classOrObject) {
            self::methodNotExists($classOrObject, $method, $message);
        }
    }

    /**
     * @param null|array|Countable $array
     * @param float|int            $min
     * @param string               $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrMinCount($array, $min, $message = ''): void
    {
        if (null !== $array) {
            self::minCount($array, $min, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param float|int   $min
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrMinLength($value, $min, $message = ''): void
    {
        if (null !== $value) {
            self::minLength($value, $min, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert positive-int|0|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNatural($value, $message = ''): void
    {
        if (null !== $value) {
            self::natural($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $subString
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotContains($value, $subString, $message = ''): void
    {
        if (null !== $value) {
            self::notContains($value, $subString, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotEmpty($value, $message = ''): void
    {
        if (null !== $value) {
            self::notEmpty($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $suffix
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotEndsWith($value, $suffix, $message = ''): void
    {
        if (null !== $value) {
            self::notEndsWith($value, $suffix, $message);
        }
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotEq($value, $expect, $message = ''): void
    {
        if (null !== $value) {
            self::notEq($value, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotFalse($value, $message = ''): void
    {
        if (null !== $value) {
            self::notFalse($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotInstanceOf($value, $class, $message = ''): void
    {
        if (null !== $value) {
            self::notInstanceOf($value, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $pattern
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotRegex($value, $pattern, $message = ''): void
    {
        if (null !== $value) {
            self::notRegex($value, $pattern, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotSame($value, $expect, $message = ''): void
    {
        if (null !== $value) {
            self::notSame($value, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $prefix
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotStartsWith($value, $prefix, $message = ''): void
    {
        if (null !== $value) {
            self::notStartsWith($value, $prefix, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNotWhitespaceOnly($value, $message = ''): void
    {
        if (null !== $value) {
            self::notWhitespaceOnly($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert numeric|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrNumeric($value, $message = ''): void
    {
        if (null !== $value) {
            self::numeric($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert object|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrObject($value, $message = ''): void
    {
        if (null !== $value) {
            self::object($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrOneOf($value, array $values, $message = ''): void
    {
        if (null !== $value) {
            self::oneOf($value, $values, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert positive-int|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrPositiveInteger($value, $message = ''): void
    {
        if (null !== $value) {
            self::positiveInteger($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param class-string|object|null $classOrObject
     *
     * @param null|object|string $classOrObject
     * @param mixed              $property
     * @param string             $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrPropertyExists($classOrObject, $property, $message = ''): void
    {
        if (null !== $classOrObject) {
            self::propertyExists($classOrObject, $property, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param class-string|object|null $classOrObject
     *
     * @param null|object|string $classOrObject
     * @param mixed              $property
     * @param string             $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrPropertyNotExists($classOrObject, $property, $message = ''): void
    {
        if (null !== $classOrObject) {
            self::propertyNotExists($classOrObject, $property, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $min
     * @param mixed  $max
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrRange($value, $min, $max, $message = ''): void
    {
        if (null !== $value) {
            self::range($value, $min, $max, $message);
        }
    }

    /**
     * @param null|string $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrReadable($value, $message = ''): void
    {
        if (null !== $value) {
            self::readable($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $pattern
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrRegex($value, $pattern, $message = ''): void
    {
        if (null !== $value) {
            self::regex($value, $pattern, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert resource|null $value
     *
     * @param mixed       $value
     * @param null|string $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrResource($value, $type = null, $message = ''): void
    {
        if (null !== $value) {
            self::resource($value, $type, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrSame($value, $expect, $message = ''): void
    {
        if (null !== $value) {
            self::same($value, $expect, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert scalar|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrScalar($value, $message = ''): void
    {
        if (null !== $value) {
            self::scalar($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $prefix
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrStartsWith($value, $prefix, $message = ''): void
    {
        if (null !== $value) {
            self::startsWith($value, $prefix, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrStartsWithLetter($value, $message = ''): void
    {
        if (null !== $value) {
            self::startsWithLetter($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert string|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrString($value, $message = ''): void
    {
        if (null !== $value) {
            self::string($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert non-empty-string|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrStringNotEmpty($value, $message = ''): void
    {
        if (null !== $value) {
            self::stringNotEmpty($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert class-string<ExpectedType>|ExpectedType|null $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrSubclassOf($value, $class, $message = ''): void
    {
        if (null !== $value) {
            self::subclassOf($value, $class, $message);
        }
    }

    /**
     * @psalm-param class-string<Throwable> $class
     *
     * @param null|Closure $expression
     * @param string       $class
     * @param string       $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrThrows($expression, $class = 'Exception', $message = ''): void
    {
        if ($expression instanceof Closure) {
            self::throws($expression, $class, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert true|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrTrue($value, $message = ''): void
    {
        if (null !== $value) {
            self::true($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrUnicodeLetters($value, $message = ''): void
    {
        if (null !== $value) {
            self::unicodeLetters($value, $message);
        }
    }

    /**
     * @param null|array $values
     * @param string     $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrUniqueValues($values, $message = ''): void
    {
        if (null !== $values) {
            self::uniqueValues($values, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrUpper($value, $message = ''): void
    {
        if (null !== $value) {
            self::upper($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @param null|string $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrUuid($value, $message = ''): void
    {
        if (null !== $value) {
            self::uuid($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert array-key|null $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrValidArrayKey($value, $message = ''): void
    {
        if (null !== $value) {
            self::validArrayKey($value, $message);
        }
    }

    /**
     * @param null|string $value
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function nullOrWritable($value, $message = ''): void
    {
        if (null !== $value) {
            self::writable($value, $message);
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert numeric $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function numeric($value, $message = ''): void
    {
        if (! is_numeric($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a numeric. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert object $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function object($value, $message = ''): void
    {
        if (! is_object($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an object. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * A more human-readable alias of Assert::inArray().
     *
     * @psalm-pure
     *
     * @param mixed  $value
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function oneOf($value, array $values, $message = ''): void
    {
        self::inArray($value, $values, $message);
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert positive-int $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function positiveInteger($value, $message = ''): void
    {
        if (! (is_int($value) && $value > 0)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a positive integer. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param class-string|object $classOrObject
     *
     * @param object|string $classOrObject
     * @param mixed         $property
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function propertyExists($classOrObject, $property, $message = ''): void
    {
        if (! property_exists($classOrObject, $property)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected the property %s to exist.',
                self::valueToString($property),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-param class-string|object $classOrObject
     *
     * @param object|string $classOrObject
     * @param mixed         $property
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function propertyNotExists($classOrObject, $property, $message = ''): void
    {
        if (property_exists($classOrObject, $property)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected the property %s to not exist.',
                self::valueToString($property),
            ));
        }
    }

    /**
     * Inclusive range, so Assert::(3, 3, 5) passes.
     *
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $min
     * @param mixed  $max
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function range($value, $min, $max, $message = ''): void
    {
        if ($value < $min || $value > $max) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value between %2$s and %3$s. Got: %s',
                self::valueToString($value),
                self::valueToString($min),
                self::valueToString($max),
            ));
        }
    }

    /**
     * @param string $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function readable($value, $message = ''): void
    {
        if (! is_readable($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'The path %s is not readable.',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $pattern
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function regex($value, $pattern, $message = ''): void
    {
        if (! preg_match($pattern, $value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'The value %s does not match the expected pattern.',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert resource $value
     *
     * @param mixed       $value
     * @param null|string $type    type of resource this should be. @see https://www.php.net/manual/en/function.get-resource-type.php
     * @param string      $message
     *
     * @throws InvalidArgumentException
     */
    public static function resource($value, $type = null, $message = ''): void
    {
        if (! is_resource($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a resource. Got: %s',
                self::typeToString($value),
            ));
        }

        if ($type && $type !== get_resource_type($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a resource of type %2$s. Got: %s',
                self::typeToString($value),
                $type,
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param mixed  $expect
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function same($value, $expect, $message = ''): void
    {
        if ($expect !== $value) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value identical to %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($expect),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert scalar $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function scalar($value, $message = ''): void
    {
        if (! is_scalar($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a scalar. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $prefix
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function startsWith($value, $prefix, $message = ''): void
    {
        if (! str_starts_with($value, $prefix)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to start with %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($prefix),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function startsWithLetter($value, $message = ''): void
    {
        self::string($value);

        $valid = isset($value[0]);

        if ($valid) {
            $locale = setlocale(LC_CTYPE, 0);
            setlocale(LC_CTYPE, 'C');
            $valid = ctype_alpha($value[0]);
            setlocale(LC_CTYPE, $locale);
        }

        if (! $valid) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to start with a letter. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert string $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function string($value, $message = ''): void
    {
        if (! is_string($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a string. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert non-empty-string $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function stringNotEmpty($value, $message = ''): void
    {
        self::string($value, $message);
        self::notEq($value, '', $message);
    }

    /**
     * @psalm-pure
     *
     * @psalm-template ExpectedType of object
     *
     * @psalm-param class-string<ExpectedType> $class
     *
     * @psalm-assert class-string<ExpectedType>|ExpectedType $value
     *
     * @param mixed         $value
     * @param object|string $class
     * @param string        $message
     *
     * @throws InvalidArgumentException
     */
    public static function subclassOf($value, $class, $message = ''): void
    {
        if (! is_subclass_of($value, $class)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a sub-class of %2$s. Got: %s',
                self::valueToString($value),
                self::valueToString($class),
            ));
        }
    }

    /**
     * @psalm-param class-string<Throwable> $class
     *
     * @param Closure $expression
     * @param string  $class
     * @param string  $message
     *
     * @throws InvalidArgumentException
     */
    public static function throws(Closure $expression, $class = 'Exception', $message = ''): void
    {
        self::string($class);

        $actual = 'none';

        try {
            $expression();
        } catch (Exception $exception) {
            $actual = $exception::class;
            if ($exception instanceof $class) {
                return;
            }
        } catch (Throwable $throwable) {
            $actual = $throwable::class;
            if ($throwable instanceof $class) {
                return;
            }
        }

        self::reportInvalidArgument($message ?: sprintf(
            'Expected to throw "%s", got "%s"',
            $class,
            $actual,
        ));
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert true $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function true($value, $message = ''): void
    {
        if (true !== $value) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to be true. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function unicodeLetters($value, $message = ''): void
    {
        self::string($value);

        if (! preg_match('#^\p{L}+$#u', $value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain only Unicode letters. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * Does non strict comparisons on the items, so ['3', 3] will not pass the assertion.
     *
     * @param array  $values
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function uniqueValues(array $values, $message = ''): void
    {
        $allValues = count($values);
        $uniqueValues = count(array_unique($values));

        if ($allValues !== $uniqueValues) {
            $difference = $allValues - $uniqueValues;

            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected an array of unique values, but %s of them %s duplicated',
                $difference,
                (1 === $difference ? 'is' : 'are'),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert !lowercase-string $value
     *
     * @param string $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function upper($value, $message = ''): void
    {
        $locale = setlocale(LC_CTYPE, 0);
        setlocale(LC_CTYPE, 'C');
        $valid = ! ctype_upper($value);
        setlocale(LC_CTYPE, $locale);

        if ($valid) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to contain uppercase characters only. Got: %s',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function uuid($value, $message = ''): void
    {
        $value = str_replace(['urn:', 'uuid:', '{', '}'], '', $value);

        // The nil UUID is special form of UUID that is specified to have all
        // 128 bits set to zero.
        if ('00000000-0000-0000-0000-000000000000' === $value) {
            return;
        }

        if (! preg_match('#^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$#', $value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Value %s is not a valid UUID.',
                self::valueToString($value),
            ));
        }
    }

    /**
     * Checks if a value is a valid array key (int or string).
     *
     * @psalm-pure
     *
     * @psalm-assert array-key $value
     *
     * @param mixed  $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function validArrayKey($value, $message = ''): void
    {
        if (! is_int($value) && ! is_string($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'Expected string or integer. Got: %s',
                self::typeToString($value),
            ));
        }
    }

    /**
     * @param string $value
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    public static function writable($value, $message = ''): void
    {
        if (! is_writable($value)) {
            self::reportInvalidArgument(sprintf(
                $message ?: 'The path %s is not writable.',
                self::valueToString($value),
            ));
        }
    }

    /**
     * @param string $message
     *
     * @throws InvalidArgumentException
     */
    private static function reportInvalidArgument($message): never
    {
        throw new InvalidArgumentException($message);
    }

    private static function strlen($value): int
    {
        if (! function_exists('mb_detect_encoding')) {
            return mb_strlen($value);
        }

        if (false === $encoding = mb_detect_encoding($value, mb_detect_order(), true)) {
            return mb_strlen($value);
        }

        return mb_strlen($value, $encoding);
    }

    /**
     * @param mixed $value
     */
    private static function typeToString($value): string
    {
        return get_debug_type($value);
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    private static function valueToString($value)
    {
        if (null === $value) {
            return 'null';
        }

        if (true === $value) {
            return 'true';
        }

        if (false === $value) {
            return 'false';
        }

        if (is_array($value)) {
            return 'array';
        }

        if (is_object($value)) {
            if (method_exists($value, '__toString')) {
                return $value::class . ': ' . self::valueToString($value->__toString());
            }

            if ($value instanceof DateTimeImmutable) {
                return $value::class . ': ' . self::valueToString($value->format('c'));
            }

            return $value::class;
        }

        if (is_resource($value)) {
            return 'resource';
        }

        if (is_string($value)) {
            return '"' . $value . '"';
        }

        return (string) $value;
    }
}
