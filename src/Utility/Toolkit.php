<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Utility\Toolkit\Assert;
use Auth0\SDK\Utility\Toolkit\Filter;

/**
 * A convenience class wrapping various helper methods.
 */
final class Toolkit
{
    /**
     * Convenience methods for asserting the content of values.
     *
     * @param array<mixed> $subjects An array of values to work with.
     */
    public static function assert(
        array $subjects
    ): Assert {
        return new Assert($subjects);
    }

    /**
     * Convenience methods for filtering the content of values.
     *
     * @param array<mixed> $subjects An array of values to work with.
     */
    public static function filter(
        array $subjects
    ): Filter {
        return new Filter($subjects);
    }

    /**
     * Run a function a certain number of times.
     *
     * @param int $times The number of times to run $callback.
     * @param \Closure $callback The function to run.
     */
    public static function times(
        int $times,
        \Closure $callback
    ): void {
        for ($i = 0; $i < $times; $i++) {
            $callback();
        }
    }

    /**
     * Pass each item in an iterable through a function.
     *
     * @param iterable<mixed> $items The iterable to process.
     * @param \Closure $callback The function to pass each item through.
     */
    public static function each(
        iterable & $items,
        \Closure $callback
    ): void {
        foreach ($items as $key => &$item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }
    }

    /**
     * Progressively merge one or more arrays, overwriting values from left to right. Null values is discarded.
     *
     * @param array<mixed>|null $arrays One or more arrays to merge.
     *
     * @return array<mixed>
     */
    public static function merge(
        ...$arrays
    ): array {
        $result = [];

        foreach ($arrays as $array) {
            if (is_array($array) && count($array) !== 0) {
                [$merging] = self::filter([$array])->array()->trim();

                if (count($merging) !== 0) {
                    $result = array_merge($result, $merging);
                }
            }
        }

        return self::filter([$result])->array()->trim()[0];
    }

    /**
     * Throw an $exception or return false if any of the provided values are null.
     *
     * @param \Throwable|null $exception An exception to throw if all values are null.
     * @param array<mixed>    $values    One or more values to check.
     *
     * @throws \Throwable If there are no non-null values.
     */
    public static function every(
        ?\Throwable $exception,
        array $values
    ): bool {
        foreach ($values as $value) {
            if ($value === null) {
                if ($exception !== null) {
                    throw $exception;
                }

                return false;
            }
        }

        return true;
    }

    /**
     * Throw an $exception or return false if all the provided values are null.
     *
     * @param \Throwable|null $exception An exception to throw if all values are null.
     * @param array<mixed>    $values    One or more values to check.
     *
     * @return array<mixed>|false
     *
     * @throws \Throwable If there are no non-null values.
     */
    public static function some(
        ?\Throwable $exception,
        array $values
    ) {
        // Trim the array of null values.
        [$trimmed] = self::filter([$values])->array()->trim();

        // All values were null, throw an exception.
        if (count($trimmed) === 0) {
            if ($exception !== null) {
                throw $exception;
            }

            return false;
        }

        // Return all non-null values.
        return $trimmed;
    }
}
