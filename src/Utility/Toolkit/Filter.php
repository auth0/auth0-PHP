<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Toolkit;

use Auth0\SDK\Utility\Toolkit\Filter\{ArrayFilter, StringFilter};

final class Filter
{
    /**
     * Filter Constructor.
     *
     * @param array<mixed> $subjects an array of values to process
     */
    public function __construct(
        private array $subjects,
    ) {
    }

    /**
     * Process the subjects using array filters.
     */
    public function array(): ArrayFilter
    {
        /** @var array<array<null|string>> $subjects */
        $subjects = $this->subjects;

        return new ArrayFilter($subjects);
    }

    /**
     * Process the subjects using string filters.
     */
    public function string(): StringFilter
    {
        /** @var array<null|string> $subjects */
        $subjects = $this->subjects;

        return new StringFilter($subjects);
    }
}
