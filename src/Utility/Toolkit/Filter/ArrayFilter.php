<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Toolkit\Filter;

use Auth0\SDK\Utility\Toolkit;
use Throwable;

use function array_slice;
use function is_array;
use function is_string;

final class ArrayFilter
{
    /**
     * StringFilter constructor.
     *
     * @param array<array<mixed>> $subjects an array of arrays to filter
     */
    public function __construct(
        private array $subjects,
    ) {
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
            if ([] === $subject) {
                $results[] = null;

                continue;
            }

            $results[] = $subject;
        }

        return $results;
    }

    /**
     * Throw an error if all the provided values are null. Otherwise, return the first non-null value.
     *
     * @param Throwable $exception an exception to throw if all values are null
     *
     * @throws Throwable if all $values are null
     *
     * @return array<mixed>
     */
    public function first(
        Throwable $exception,
    ): array {
        $results = [];

        foreach ($this->subjects as $subject) {
            /** @var null|array<mixed> $subject */
            if (! is_array($subject)) {
                continue;
            }
            if ([] === $subject) {
                continue;
            }
            $values = Toolkit::some($exception, $subject);

            if (false !== $values) {
                $results[] = array_slice($values, 0)[0];

                continue;
            }
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
            if ([] === $subject) {
                $results[] = null;

                continue;
            }

            $results[] = (object) $subject;
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

            if ([] !== $subject) {
                $payload['permissions'] = [];

                foreach ($subject as $permission) {
                    /** @var array{permission_name?: string, resource_server_identifier?: string} $permission */
                    if (isset($permission['permission_name'], $permission['resource_server_identifier'])) {
                        $payload['permissions'][] = (object) $permission;
                    }
                }
            }

            $results[] = (object) $payload;
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
            /** @var null|array<mixed> $subject */
            if (! is_array($subject) || [] === $subject) {
                $results[] = [];

                continue;
            }

            $results[] = array_map(static function ($val) {
                if (is_string($val)) {
                    return (new StringFilter([$val]))->trim()[0];
                }

                return $val;
            }, array_filter($subject, static fn ($val): bool => null !== $val));
        }

        return $results;
    }
}
