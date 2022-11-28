<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Toolkit;

use Auth0\SDK\Utility\Toolkit\Filter\ArrayFilter;
use Auth0\SDK\Utility\Toolkit\Filter\StringFilter;

/**
 * Class Filter.
 */
final class Filter
{
    /**
     * Filter Constructor.
     *
     * @param  array<mixed>  $subjects  an array of values to process
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
        /** @var array<array<string|null>> $subjects */
        $subjects = $this->subjects;

        return new ArrayFilter($subjects);
    }

    /**
     * Process the subjects using string filters.
     */
    public function string(): StringFilter
    {
        /** @var array<string|null> $subjects */
        $subjects = $this->subjects;

        return new StringFilter($subjects);
    }
}
