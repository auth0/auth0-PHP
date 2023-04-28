<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Utility\Toolkit\{Assert, Filter};
use Closure;
use Throwable;

use function is_array;

/**
 * A convenience class wrapping various helper methods.
 */
final class Toolkit
{
    /**
     * Convenience methods for asserting the content of values.
     *
     * @param array<array{0: mixed, 1: Throwable}> $subjects an array of values to work with
     */
    public static function assert(
        array $subjects,
    ): Assert {
        return new Assert($subjects);
    }

    /**
     * Pass each item in an iterable through a function.
     *
     * @param iterable<mixed> $items    the iterable to process
     * @param Closure         $callback the function to pass each item through
     */
    public static function each(
        iterable &$items,
        Closure $callback,
    ): void {
        foreach ($items as $key => &$item) {
            if (false === $callback($item, $key)) {
                break;
            }
        }
    }

    /**
     * Throw an $exception or return false if any of the provided values are null.
     *
     * @param null|Throwable $exception an exception to throw if all values are null
     * @param array<mixed>   $values    one or more values to check
     *
     * @throws Throwable if there are no non-null values
     */
    public static function every(
        ?Throwable $exception,
        array $values,
    ): bool {
        foreach ($values as $value) {
            if (null === $value) {
                if ($exception instanceof Throwable) {
                    throw $exception;
                }

                return false;
            }
        }

        return true;
    }

    /**
     * Convenience methods for filtering the content of values.
     *
     * @param array<mixed> $subjects an array of values to work with
     */
    public static function filter(
        array $subjects,
    ): Filter {
        return new Filter($subjects);
    }

    /**
     * Progressively merge one or more arrays, overwriting values from left to right. Null values is discarded.
     *
     * @param mixed[] $arrays one or more arrays to merge
     *
     * @return array<mixed>
     *
     * @codeCoverageIgnore
     */
    public static function merge(
        array $arrays = [],
    ): array {
        $result = [];

        foreach ($arrays as $array) {
            if (is_array($array) && [] !== $array) {
                /** @var array<mixed> $merging */
                [$merging] = self::filter([$array])->array()->trim();

                if ([] !== $merging) {
                    $result = array_merge($result, $merging);
                }
            }
        }

        if (is_array($response = self::filter([$result])->array()->trim()[0])) {
            return $response;
        }

        return [];
    }

    /**
     * Throw an $exception or return false if all the provided values are null.
     *
     * @param null|Throwable $exception an exception to throw if all values are null
     * @param array<mixed>   $values    one or more values to check
     *
     * @throws Throwable if there are no non-null values
     *
     * @return array<mixed>|false
     */
    public static function some(
        ?Throwable $exception,
        array $values,
    ) {
        /** @var array<mixed> $trimmed */
        [$trimmed] = self::filter([$values])->array()->trim(); // Trim the array of null values.

        // All values were null, throw an exception.
        if ([] === $trimmed) {
            if ($exception instanceof Throwable) {
                throw $exception;
            }

            return false;
        }

        // Return all non-null values.
        return $trimmed;
    }

    /**
     * Run a function a certain number of times.
     *
     * @param int     $times    the number of times to run $callback
     * @param Closure $callback the function to run
     */
    public static function times(
        int $times,
        Closure $callback,
    ): void {
        for ($i = 0; $i < $times; ++$i) {
            $callback();
        }
    }
}
