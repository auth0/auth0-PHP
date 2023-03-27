<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Toolkit\Filter;

use function is_string;

final class StringFilter
{
    /**
     * StringFilter constructor.
     *
     * @param array<null|string> $subjects an array of string or null values
     */
    public function __construct(
        private array $subjects,
    ) {
    }

    /**
     * Nullsafe trim. Trims the array of string values, or sets their value when invalid or empty.
     *
     * @return array<null|string>
     */
    public function trim(): array
    {
        $results = [];

        foreach ($this->subjects as $subject) {
            if (! is_string($subject)) {
                $results[] = null;

                continue;
            }

            $value = trim($subject);

            if (0 === mb_strlen($value)) {
                $results[] = null;

                continue;
            }

            $results[] = $value;
        }

        return $results;
    }
}
