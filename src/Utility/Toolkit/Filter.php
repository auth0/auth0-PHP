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
     * Values to process.
     *
     * @var array<array|string|null>
     */
    private array $subjects;

    /**
     * Filter Constructor
     *
     * @param array<array|string|null> $subjects An array of values to process.
     */
    public function __construct(
        array $subjects
    ) {
        $this->subjects = $subjects;
    }

    /**
     * Process the subjects using array filters.
     */
    public function array(): ArrayFilter
    {
        return new ArrayFilter($this->subjects);
    }

    /**
     * Process the subjects using string filters.
     */
    public function string(): StringFilter
    {
        return new StringFilter($this->subjects);
    }
}
