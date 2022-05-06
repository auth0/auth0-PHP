<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Toolkit\Filter;

use Auth0\SDK\Utility\Toolkit;

/**
 * Class ArrayFilter.
 */
final class ArrayFilter
{
    /**
     * Values to process.
     *
     * @var array<array<mixed>>
     */
    private array $subjects;

    /**
     * StringFilter constructor.
     *
     * @param array<array<mixed>> $subjects An array of arrays to filter.
     */
    public function __construct(
        array $subjects
    ) {
        $this->subjects = $subjects;
    }

    /**
     * If an array is null or empty, return a null; otherwise return the array.
     *
     * @return array<mixed>
     */
    public function empty(): array
    {
        $results = [];

        foreach ($this->subjects as $subject) {
            if ($subject === []) {
                $results[] = null;
                continue;
            }

            $results[] = $subject;
        }

        return $results;
    }

    /**
     * Return the subject as a null if empty, or cast to an object otherwise.
     *
     * @return array<mixed>
     */
    public function object(): array
    {
        $results = [];

        foreach ($this->subjects as $subject) {
            if ($subject === []) {
                $results[] = null;
                continue;
            }

            $results[] = (object) $subject;
        }

        return $results;
    }

    /**
     * Trim all null values from an array.
     *
     * @return array<mixed>
     */
    public function trim(): array
    {
        $results = [];

        foreach ($this->subjects as $subject) {
            /** @var array<mixed>|null $subject */
            if (! is_array($subject) || $subject === []) {
                $results[] = [];
                continue;
            }

            $results[] = array_map(static function ($val) {
                if (is_string($val)) {
                    return (new StringFilter([$val]))->trim()[0];
                }

                return $val;
            }, array_filter($subject, static fn ($val) => $val !== null));
        }

        return $results;
    }

    /**
     * Throw an error if all the provided values are null. Otherwise, return the first non-null value.
     *
     * @param \Throwable $exception An exception to throw if all values are null.
     *
     * @return array<mixed>
     *
     * @throws \Throwable If all $values are null.
     */
    public function first(
        \Throwable $exception
    ) {
        $results = [];

        foreach ($this->subjects as $subject) {
            /** @var array<mixed>|null $subject */

            if (! is_array($subject) || $subject === []) {
                continue;
            }

            $values = Toolkit::some($exception, $subject);

            if ($values !== false) {
                $results[] = array_slice($values, 0)[0];
                continue;
            }
        }

        return $results;
    }

    /**
     * Convert an array into a permissions object.
     *
     * @return array<object>
     */
    public function permissions(): array
    {
        $results = [];

        foreach ($this->subjects as $subject) {
            $payload = [];

            if ($subject !== []) {
                $payload['permissions'] = [];

                foreach ($subject as $permission) {
                    /** @var array{permission_name?: string, resource_server_identifier?: string} $permission */
                    if (isset($permission['permission_name']) && isset($permission['resource_server_identifier'])) {
                        $payload['permissions'][] = (object) $permission;
                    }
                }
            }

            $results[] = (object) $payload;
        }

        return $results;
    }
}
