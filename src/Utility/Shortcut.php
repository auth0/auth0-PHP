<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

/**
 * Class Validate.
 */
final class Shortcut
{
    /**
     * Accept a null or string value, and return a null or trimmed string value.
     *
     * @param string|null $value The value to trim, if a string, or null.
     */
    public static function trimNull(
        ?string $value
    ): ?string {
        if ($value === null) {
            return null;
        }

        return trim($value);
    }

    /**
     * Progressively merge any number of arrays, overwriting values from left to right. Filters null values.
     *
     * @param array<mixed>|null $arrays One or more arrays to merge and filter.
     *
     * @return array<mixed>
     */
    public static function mergeArrays(
        ?array ...$arrays
    ): array {
        $response = [];

        foreach ($arrays as $array) {
            if (is_array($array) && count($array) !== 0) {
                $response = array_merge($response, $array);
            }
        }

        return self::filterArray($response);
    }

    /**
     * Filter null values from an array.
     *
     * @param array<mixed>|null $array An array ot filter null values from.
     *
     * @return array<mixed>
     */
    public static function filterArray(
        ?array $array
    ): array {
        if ($array === null || count($array) === 0) {
            return [];
        }

        return array_filter($array, static fn ($value) => $value !== null);
    }
}
